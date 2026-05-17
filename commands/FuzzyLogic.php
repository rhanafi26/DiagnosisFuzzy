<?php
namespace app\commands;
use app\models\Rule;
use app\models\Disease;
use app\models\Symptom;

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
}
