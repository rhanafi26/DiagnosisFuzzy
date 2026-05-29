<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Hasil Diagnosis';
$this->params['breadcrumbs'][] = ['label' => 'Diagnosa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Pilih Gejala', 'url' => ['select-symptoms']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="diagnosis-result">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                    <h4 class="text-white mb-0">
                        <i class="fas fa-file-medical-alt"></i> Hasil Diagnosis
                    </h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <div class="row">
                            <div class="col-md-6">
                                <strong><i class="fas fa-user"></i> Nama Pasien:</strong> <?= Html::encode($patientName) ?>
                            </div>
                            <div class="col-md-6">
                                <strong><i class="fas fa-calendar-alt"></i> Usia:</strong> <?= Html::encode($patientAge) ?> tahun
                            </div>
                        </div>
                    </div>
                    
                    <?php if (!empty($results)): ?>
                        <?php $topResult = $results[0]; ?>
                        
                        <!-- Hasil Utama -->
                        <div class="card mb-4 border-<?= $topResult['severity_category'] == 'Ringan' ? 'success' : ($topResult['severity_category'] == 'Sedang' ? 'warning' : ($topResult['severity_category'] == 'Parah' ? 'danger' : 'dark')) ?>">
                            <div class="card-header bg-<?= $topResult['severity_category'] == 'Ringan' ? 'success' : ($topResult['severity_category'] == 'Sedang' ? 'warning' : ($topResult['severity_category'] == 'Parah' ? 'danger' : 'dark')) ?> text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-exclamation-triangle"></i> Diagnosis Utama
                                </h5>
                            </div>
                            <div class="card-body text-center">
                                <h2><?= Html::encode($topResult['disease']['name']) ?></h2>
                                <p class="text-muted">(<?= $topResult['disease']['code'] ?>)</p>
                                
                                <!-- Deskripsi penyakit -->
                                <?php if (!empty($topResult['disease']['description'])): ?>
                                    <div class="mt-2 mb-3">
                                        <p><?= Html::encode($topResult['disease']['description']) ?></p>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Progress bar tingkat keparahan -->
                                <div class="mt-3">
                                    <label><strong>Tingkat Keparahan:</strong></label>
                                    <div class="progress" style="height: 30px;">
                                        <?php 
                                        $progressColor = 'bg-success';
                                        if ($topResult['match_percentage'] > 25) $progressColor = 'bg-warning';
                                        if ($topResult['match_percentage'] > 50) $progressColor = 'bg-danger';
                                        if ($topResult['match_percentage'] > 75) $progressColor = 'bg-dark';
                                        ?>
                                        <div class="progress-bar progress-bar-striped progress-bar-animated <?= $progressColor ?>" 
                                             role="progressbar" 
                                             style="width: <?= $topResult['match_percentage'] ?>%;">
                                            <?= $topResult['match_percentage'] ?>%
                                        </div>
                                    </div>
                                    <?php 
                                    $badgeColor = 'success';
                                    if ($topResult['severity_category'] == 'Sedang') $badgeColor = 'warning';
                                    elseif ($topResult['severity_category'] == 'Parah') $badgeColor = 'danger';
                                    elseif ($topResult['severity_category'] == 'Sangat Parah') $badgeColor = 'dark';
                                    ?>
                                    <span class="badge bg-<?= $badgeColor ?> mt-2 p-2">
                                        <i class="fas fa-chart-line"></i> Kategori: <?= $topResult['severity_category'] ?>
                                    </span>
                                </div>
                                
                                <!-- Informasi jumlah gejala yang cocok -->
                                <div class="mt-3 text-muted">
                                    <small>
                                        <i class="fas fa-check-circle text-success"></i> 
                                        <?= $topResult['matched_count'] ?> dari <?= $topResult['required_count'] ?> gejala yang diperlukan cocok
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Gejala yang dipilih -->
                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0"><i class="fas fa-list"></i> Gejala yang Anda Pilih</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php if (!empty($symptomsDetail)): ?>
                                        <?php foreach ($symptomsDetail as $symptom): ?>
                                            <div class="col-md-4 mb-2">
                                                <span class="badge bg-primary p-2" style="font-size: 0.9rem;">
                                                    <?= $symptom->code ?> - <?= Html::encode($symptom->name) ?>
                                                </span>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle"></i> Tidak ada data gejala yang dipilih.
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kemungkinan penyakit lain -->
                        <?php if (count($results) > 1): ?>
                            <div class="card mb-4">
                                <div class="card-header bg-warning">
                                    <h5 class="mb-0"><i class="fas fa-question-circle"></i> Kemungkinan Penyakit Lain</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Nama Penyakit</th>
                                                    <th>Tingkat Keparahan</th>
                                                    <th>Kategori</th>
                                                    <th>Gejala Cocok</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i = 1; $i < min(5, count($results)); $i++): ?>
                                                    <?php $result = $results[$i]; ?>
                                                    <?php
                                                    $rowBadgeColor = 'success';
                                                    if ($result['severity_category'] == 'Sedang') $rowBadgeColor = 'warning';
                                                    elseif ($result['severity_category'] == 'Parah') $rowBadgeColor = 'danger';
                                                    elseif ($result['severity_category'] == 'Sangat Parah') $rowBadgeColor = 'dark';
                                                    
                                                    $rowProgressColor = 'bg-success';
                                                    if ($result['match_percentage'] > 25) $rowProgressColor = 'bg-warning';
                                                    if ($result['match_percentage'] > 50) $rowProgressColor = 'bg-danger';
                                                    if ($result['match_percentage'] > 75) $rowProgressColor = 'bg-dark';
                                                    ?>
                                                    <tr>
                                                        <td><strong><?= $result['disease']['code'] ?></strong></td>
                                                        <td><?= Html::encode($result['disease']['name']) ?></td>
                                                        <td>
                                                            <div class="progress" style="height: 20px;">
                                                                <div class="progress-bar <?= $rowProgressColor ?>" 
                                                                     style="width: <?= $result['match_percentage'] ?>%;">
                                                                    <?= $result['match_percentage'] ?>%
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-<?= $rowBadgeColor ?>">
                                                                <?= $result['severity_category'] ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">
                                                                <?= $result['matched_count'] ?>/<?= $result['required_count'] ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endfor; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Disclaimer -->
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            <strong>Disclaimer:</strong> Sistem ini hanya untuk membantu diagnosis awal. 
                            Hasil diagnosis ini tidak menggantikan diagnosis dari dokter profesional. 
                            Silakan konsultasikan dengan dokter untuk penanganan lebih lanjut.
                        </div>
                        
                        <!-- Tombol Aksi -->
                        <div class="text-center">
                            <?= Html::a('<i class="fas fa-redo-alt"></i> Diagnosis Ulang', ['index'], [
                                'class' => 'btn btn-primary btn-lg mx-2'
                            ]) ?>
                            <?= Html::a('<i class="fas fa-print"></i> Cetak Hasil', '#', [
                                'class' => 'btn btn-secondary btn-lg mx-2',
                                'onclick' => 'window.print();return false;'
                            ]) ?>
                            <?= Html::a('<i class="fas fa-history"></i> Lihat Riwayat', ['history'], [
                                'class' => 'btn btn-info btn-lg mx-2'
                            ]) ?>
                        </div>
                        
                    <?php else: ?>
                        <div class="alert alert-warning text-center">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                            <h4>Tidak Ada Penyakit yang Cocok</h4>
                            <p>Tidak ada penyakit yang cocok dengan gejala yang Anda pilih.</p>
                            <p>Silakan coba lagi dengan memilih gejala yang berbeda atau lebih spesifik.</p>
                            <?= Html::a('<i class="fas fa-arrow-left"></i> Kembali Pilih Gejala', ['select-symptoms'], [
                                'class' => 'btn btn-warning mt-3'
                            ]) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .btn, .navbar, .footer, .card-header .btn, .alert-danger {
        display: none !important;
    }
    .card {
        border: 1px solid #ddd !important;
        break-inside: avoid;
    }
    .progress-bar {
        background-color: #000 !important;
        color: #fff !important;
    }
    body {
        font-size: 12pt;
    }
}
</style>