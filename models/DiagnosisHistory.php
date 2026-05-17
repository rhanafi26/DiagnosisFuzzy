<?php
namespace app\models;
use yii\db\ActiveRecord;

class DiagnosisHistory extends ActiveRecord{
    public static function tableName(){
        return 'diagnosis_history';
    }
    public function rules(){
        return [
            [['patient_name', 'patient_age', 'selected_symptoms', 'diagnosis_result', 'severity_percentage', 'severity_category'], 'safe'],
            [['patient_age'], 'integer'],
            [['severity_percentage'], 'number'],
            [['patient_name'], 'string', 'max' => 100],
            [['diagnosis_result'], 'string', 'max' => 100],
            [['severity_category'], 'string', 'max' => 20],
        ];
    }
    public function attributesLabels(){
         return [
            'id' => 'ID',
            'patient_name' => 'Nama Pasien',
            'patient_age' => 'Usia',
            'selected_symptoms' => 'Gejala Dipilih',
            'diagnosis_result' => 'Hasil Diagnosis',
            'severity_percentage' => 'Tingkat Keparahan',
            'severity_category' => 'Kategori',
            'created_at' => 'Tanggal Diagnosis',
        ];
    }
    public function getSelectedSymptomsArray(){
        return json_decode($this->selected_symptom, true) ?: [];
    }
}