<?php
namespace app\models;
use yii\db\ActiveRecord;

class Disease extends ActiveRecord{
    public static function tableName(){
        return 'disease';
    }
    public static function rules(){
        return [
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 100],
            [['description', 'treatment'], 'string'],
            [['code'], 'unique'],
        ];
    }
    public static function attributeLabels(){
        return [
            'id' => 'ID',
            'code' => 'Kode Penyakit',
            'name' => 'Nama Penyakit',
            'description' => 'Deskripsi',
            'treatment' => 'Penanganan',
        ];
    }
    public function getRules(){
        return $this->hasMany(Rule::class, ['disease_id'=>'id']);
    }
    public function getSymptoms(){
        return $this->hasMany(Symptom::class, ['code' => 'symptom_code'])
            ->viaTable('rule', ['disease_id' => 'id']);
    }
    public function getRequiredSymptomsCodes(){
        return Rule::find()
            ->where(['disease_id' => $this->id])
            ->select('symptom_code')
            ->column();
    }
    public static function getSeverityCategory($percentage){
        if ($percentage <= 25) return 'Ringan';
        if ($percentage <= 50) return 'Sedang';
        if ($percentage <= 75) return 'Parah';
        return 'Sangat Parah';
    }
    public static function getSeverityColor($category){
        $colors = [
            'Ringan' => 'success',
            'Sedang' => 'warning',
            'Parah' => 'danger',
            'Sangat Parah' => 'dark',
        ];
        return $colors[$category] ?? 'secondary';
    }
}