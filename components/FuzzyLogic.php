<?php
namespace app\components;

use app\models\Rule;
use app\models\Disease;
use app\models\Symptom;
use yii\helpers\VarDumper;

class FuzzyLogic{
    //sugeno metode
    public static function fuzzification($weight, $minValue, $maxValue){
        if($weight >= 0 && $weight <= 0.4){
            $b = 0.2;
            $a = 0.0;
            $c = 0.4;

            if ($weight <= $a) return 0;
            if ($weight <= $b) return ($weight - $a) / ($b - $a);
            if ($weight <= $c) return ($c - $weight) / ($c - $b);
            return 0;
        }elseif($weight >= 0.3 && $weight <=0.7){
            $b = 0.5;
            $a = 0.3;
            $c = 0.7;
            
            if ($weight <= $a) return 0;
            if ($weight <= $b) return ($weight - $a) / ($b - $a);
            if ($weight <= $c) return ($c - $weight) / ($c - $b);
            return 0;
        }elseif($weight >= 0.6 && $weight <= 1.0){
            $b = 0.8;
            $a = 0.6;
            $c = 1.0;
            
            if ($weight <= $a) return 0;
            if ($weight <= $b) return ($weight - $a) / ($b - $a);
            if ($weight <= $c) return ($c - $weight) / ($c - $b);
            return 0;
        }
        return 0;
    }
    //defuzzifikasi metode sugeno
    public static function defuzzification($selectedSymptoms, $requiredSymptomCodes){
        $nominator = 0;
        $denominator = 0;

        foreach ($requiredSymptomCodes as $symptomCode){
            if(isset($selectedSymptoms[$symptomCode])){
                $symptom = $selectedSymptoms[$symptomCode];
                $fuzzValue = self::fuzzification(
                    floatval($symptom->weight),
                    floatval($symptom->min_value),
                    floatval($symptom->max_value)
                );
                $nominator += $fuzzValue * floatval($symptom->weight);
            $denominator += $fuzzValue;
            }
            
        }
        if ($denominator == 0 ) return 0;
    return $nominator / $denominator;
    }
    public static function diagnose($selectedSymptomCodes){
            $allSymptoms = Symptom::find()->indexBy('code')->all();
            $selectedSymptom = [];
            foreach ($selectedSymptomCodes as $code){
                if(isset($allSymptoms[$code])){
                    $selectedSymptom[$code] = $allSymptoms[$code];
                }
            }
            if(empty($selectedSymptom)){
                return [];
            }
            $results = [];
            $diseases = Disease::find()->all();

            foreach ($diseases as $disease){
                $requiredSymptomCodes = $disease -> getRequiredSymptomCodes();
                
                $matchedSymptoms = array_intersect($selectedSymptomCodes, $requiredSymptomCodes);
                
                $matchCount = count($matchedSymptoms);
                $requiredCount = count($requiredSymptomCodes);
                
                if ($matchCount > 0){
                    // $fuzzValue = self::defuzzification($selectedSymptomCodes, $requiredSymptomCodes);
                    $fuzzValue = self::defuzzification($selectedSymptom, $requiredSymptomCodes);
                    $matchPercentage = $fuzzValue * 100;

                    if ($matchPercentage < 10 && $matchCount > 0 ){
                        $matchPercentage = ($matchCount / $requiredCount) * 50;
                    }
                    $results[]= [
                    'disease' => $disease,
                    'match_percentage' => round(min($matchPercentage, 100), 2),
                    'severity_category' => Disease::getSeverityCategory($matchPercentage),
                    'matched_symptoms' => $matchedSymptoms,
                    'matched_count' => $matchCount,
                    'required_count' => $requiredCount,
                    ];
                }
            }
            usort($results, function($a, $b){
    return $b['match_percentage'] <=> $a['match_percentage'];
});
            return $results;
    }
}
