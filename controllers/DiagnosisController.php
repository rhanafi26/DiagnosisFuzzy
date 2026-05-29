<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Symptom;
use app\models\Disease;
use app\models\Rule;
use app\models\DiagnosisHistory;
use app\components\FuzzyLogic;
use yii\base\DynamicModel;
use yii\helpers\VarDumper;

class DiagnosisController extends Controller{
    public function actionDebug(){
    Yii::$app->response->format = Response::FORMAT_JSON;
    
    $symptoms = Symptom::find()->count();
    $diseases = Disease::find()->count();
    $rules = Rule::find()->count();
    
    return [
        'total_symptoms' => $symptoms,
        'total_diseases' => $diseases,
        'total_rules' => $rules,
        'message' => 'Database OK' . ($rules == 0 ? ' TAPI RULE KOSONG!' : '')
    ];
    }
    public function beforeAction($action){
        if ($action->id == 'process') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
    public function behaviors(){
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'process' => ['POST'],
                    'reset' => ['POST'],
                ],
            ],
        ];
    }
    public function actionIndex(){
        Yii::$app->session->remove('diagnosis_results');
        Yii::$app->session->remove('selected_symptoms');

        $model = new DynamicModel(['patient_name', 'patient_age']);
        $model->addRule(['patient_name', 'patient_age'], 'required');
        $model->addRule(['patient_age'], 'integer', ['min' => 0, 'max' => 120]);

        if ($model->load(Yii::$app->request->post())&& $model->validate()){
            Yii::$app->session->set('patient_name', $model->patient_name);
            Yii::$app->session->set('patient_age', $model->patient_age);
            return $this->redirect(['select-symptoms']);
        }
        return $this->render('index',['model'=>$model,
        ]);
    }
    public function actionSelectSymptoms(){
        $patient_name = Yii::$app->session->get('patient_name');
        if(!$patient_name){
            return $this->redirect(['index']);
        }
        $symptomsGrouped = Symptom::getGroupedByCategory();
        return $this->render('select-symptoms', [
            'symptomsGrouped'=> $symptomsGrouped,
            'patientName'=> $patient_name,
        ]);
    }
    public function actionProcess(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $selectedSymptoms = Yii::$app->request->post('symptoms', []);
        

        
        if (empty($selectedSymptoms)) {
            return [
                'success' => false,
                'message' => 'Silakan pilih minimal satu gejala'
            ];  
        } 
        $results = FuzzyLogic::diagnose($selectedSymptoms);
        
        if (empty($results)) {
            return [
                'success' => false,
                'message' => 'Tidak ada penyakit yang cocok dengan gejala yang dipilih'
            ];
        }
        Yii::$app->session->set('diagnosis_results', $results);
        Yii::$app->session->set('selected_symptoms', $selectedSymptoms);
        return [
            'success'=> true,
            'redirect' => Yii::$app->urlManager->createUrl(['diagnosis/result'])
        ];
    }
    public function actionResult(){
        $results = Yii::$app->session->get('diagnosis_results');
        $selectedSymptoms = Yii::$app->session->get('selected_symptoms');
        $patientName = Yii::$app->session->get('patient_name');
        $patientAge = Yii::$app->session->get('patient_age');

        if(!$results){
            return $this->redirect(['index']);
        }
        $symptomsDetail = Symptom::find()
            ->where(['in', 'code', $selectedSymptoms])
            ->all();
        if(!empty($results)){
            $topResult = $results[0];
            $history = new DiagnosisHistory();
            $history->patient_name = $patientName;
            $history->patient_age = $patientAge;
            $history->selected_symptoms = json_encode($selectedSymptoms);
            $history->diagnosis_result = $topResult['disease']['name'];
            $history->severity_percentage = $topResult['match_percentage'];
            $history->severity_category = $topResult['severity_category'];
            $history->save();   
        }
        return $this->render('result', [
            'results' => $results,
            'symptomsDetail' => $symptomsDetail,
            'patientName' => $patientName,
            'patientAge' => $patientAge,
        ]);
    }
    public function actionHistory(){
       $histories = DiagnosisHistory::find()
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(50)
            ->all();
        
        return $this->render('history', [
            'histories' => $histories,
        ]);
    }
    public function actionDiseaseDetail($id){
        $disease = Disease::findOne($id);
        if(!$disease){
            throw new NotFoundHttpException('penyakit tidak ditemukan');
        }
        $symptoms = $disease->getSymptoms()->all();
        return $this->render('disease_detail', [
            'disease'=>$disease,
            'symptoms'=>$symptoms,
        ]);
    }
    public function actionTestRules(){
    header('Content-Type: application/json');
   
    $diseases = Disease::find()->all();
    $result = [];
    
    foreach ($diseases as $disease) {
        $symptoms = Rule::find()
            ->where(['disease_id' => $disease->id])
            ->select('symptom_code')
            ->column();
        
        $result[] = [
            'code' => $disease->code,
            'name' => $disease->name,
            'required_symptoms' => $symptoms,
            'total_symptoms' => count($symptoms)
        ];
    }
    
    echo json_encode($result, JSON_PRETTY_PRINT);
    exit;
    }
    public function actionReset(){
        Yii::$app->session->remove('diagnosis_results');
        Yii::$app->session->remove('selected_symptoms');
        Yii::$app->session->remove('patient_name');
        Yii::$app->session->remove('patient_age');

        return $this->redirect(['index']);
    }
    public function actionDeleteAll(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        try{
            $deleted = DiagnosisHistory::deleteAll();
            return [
                'success' => true,
                'message' => "berhasil menghapus $deleted riwayat diagnosis",
            ];
        }catch(\Exception $e){
            return [
                'success' => false,
                'message' => "gagal menghapus: " . $e->getMessage()
            ];
        }
    }
}
