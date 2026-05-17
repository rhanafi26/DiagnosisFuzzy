<?php
$this->title = 'Sistem Pakar Diagnosa Penyakit Pencernaan';
?>

<div class="site-index">
    <div class="p-5 mb-4 bg-light rounded-3 text-center">
        <div class="container-fluid py-5">
            <h1 class="display-4 fw-bold">Selamat Datang!</h1>
            <p class="fs-4">Sistem Pakar Diagnosa Penyakit Pencernaan</p>
            <p class="lead">Dengan Metode <strong>Fuzzy Logic Sugeno</strong></p>
            
            <hr class="my-4">
            
            <p>Sistem ini membantu mendiagnosa penyakit pencernaan berdasarkan gejala yang Anda alami.</p>
            <?= yii\helpers\Html::a('<i class="fas fa-play-circle"></i> Mulai Diagnosis', ['diagnosis/index'], [
                'class' => 'btn btn-primary btn-lg px-5'
            ]) ?>
        </div>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-database fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">20+ Penyakit</h5>
                    <p class="card-text">Terdapat lebih dari 20 jenis penyakit pencernaan yang dapat didiagnosa</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-brain fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Fuzzy Logic Sugeno</h5>
                    <p class="card-text">Menggunakan metode Fuzzy Logic Sugeno untuk perhitungan tingkat keparahan</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line fa-3x text-info mb-3"></i>
                    <h5 class="card-title">Akurat & Cepat</h5>
                    <p class="card-text">Proses diagnosis cepat dengan tingkat akurasi yang tinggi</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-6 offset-md-3">
            <div class="card bg-warning bg-opacity-10 border-warning">
                <div class="card-body text-center">
                    <i class="fas fa-exclamation-triangle text-warning fa-2x mb-2"></i>
                    <p class="mb-0 text-muted">
                        <strong>Disclaimer:</strong> Sistem ini hanya untuk membantu diagnosis awal. 
                        Konsultasikan hasilnya dengan dokter untuk penanganan lebih lanjut.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>