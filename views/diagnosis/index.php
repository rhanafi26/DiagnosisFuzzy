<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Diagnosis Penyakit Pencernaan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="diagnosis-index">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-primary text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h3 class="text-center mb-0">
                        <i class="fas fa-stethoscope"></i> <?= Html::encode($this->title) ?>
                    </h3>
                </div>
                <div class="card-body p-5">
                    <div class="alert alert-info border-0 bg-light">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle fa-2x text-info"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>Selamat Datang di Sistem Pakar Diagnosa Penyakit Pencernaan!</h5>
                                <p class="mb-0">Sistem ini menggunakan metode <strong>Fuzzy Logic Sugeno</strong> untuk membantu mendiagnosa penyakit pencernaan berdasarkan gejala yang Anda alami. Silakan isi data diri Anda terlebih dahulu.</p>
                            </div>
                        </div>
                    </div>
                    
                    <?php $form = ActiveForm::begin([
                        'id' => 'diagnosis-form',
                        'method' => 'post',
                        'options' => ['class' => 'needs-validation']
                    ]); ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'patient_name')->textInput([
                                'placeholder' => 'Masukkan nama lengkap',
                                'autofocus' => true,
                                'class' => 'form-control form-control-lg'
                            ])->label('<i class="fas fa-user"></i> Nama Pasien') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'patient_age')->textInput([
                                'type' => 'number',
                                'placeholder' => 'Masukkan usia',
                                'min' => 0,
                                'max' => 120,
                                'class' => 'form-control form-control-lg'
                            ])->label('<i class="fas fa-calendar-alt"></i> Usia (Tahun)') ?>
                        </div>
                    </div>
                    
                    <div class="form-group text-center mt-4">
                        <?= Html::submitButton('<i class="fas fa-play-circle"></i> Mulai Diagnosis', [
                            'class' => 'btn btn-primary btn-lg px-5',
                        ]) ?>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="text-center">
                        <?= Html::a('<i class="fas fa-history"></i> Lihat Riwayat Diagnosis', ['history'], [
                            'class' => 'btn btn-outline-secondary'
                        ]) ?>
                    </div>
                    
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            
            <div class="card mt-4 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-center text-muted">
                        <i class="fas fa-shield-alt"></i> Sistem ini hanya untuk membantu diagnosis awal. 
                        Konsultasikan hasilnya dengan dokter untuk penanganan lebih lanjut.
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$css = <<<CSS
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
CSS;
$this->registerCss($css);
?>