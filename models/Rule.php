<?php
namespace app\models;
use yii\db\ActiveRecord;

class Rule extends ActiveRecord{
    public static function tableName(){
        return 'rule';
    }
    public function rules(){
        return [
            [['disease_id', 'symptom_code'], 'required'],
            [['disease_id'], 'integer'],
            [['symptom_code'], 'string', 'max' => 5],
        ];
    }
    public function getDisease(){
        return $this->hasOne(Disease::class, ['id'=>'disease_id']);
    }
    public function getSymptom(){
        return $this->hasONe(Symptom::class, ['code'=>'symptom_id']);
    }
}