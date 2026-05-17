<?php
namespace app\models;

use yii\db\ActiveRecord;

class Symptom extends ActiveRecord{
    public static function tableName(){
        return 'symptom';
    }
    public function rules(){
        return [
            [['code', 'name', 'weight', 'category', 'min_value', 'max_value'], 'required'],
            [['weight', 'min_value', 'max_value'], 'number'],
            [['code'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 255],
            [['category'], 'string', 'max' => 20],
            [['code'], 'unique'],
        ];
    }
    public function attributeLabels(){
        return[
            'id' => 'ID',
            'code' => 'Kode Gejala',
            'name' => 'Nama Gejala',
            'weight' => 'Bobot Nilai',
            'category' => 'Kategori',
            'min_value' => 'Nilai Minimum',
            'max_value' => 'Nilai Maksimum',
        ];
    }
    public static function getGroupedByCategory(){
        $symptoms = self::find()->all();
        $grouped = [];
        foreach ($symptoms as $symptom) {
            $grouped[$symptom->category][] = $symptom;
        }
        return $grouped;
    }
    public static function getByCode($code){
        return self::find()->where(['code'=>$code])->one();
    }
}

