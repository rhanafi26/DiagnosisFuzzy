<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
$deleteUrl = Url::to(['diagnosis/delete-all']);
$this->title = 'Riwayat Diagnosis';
$this->params['breadcrumbs'][] = ['label' => 'Diagnosa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="diagnosis-history">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-history"></i> Riwayat Diagnosis Pasien
                    </h4>
                </div>
                <div class="card-body">
                    <?php if (empty($histories)): ?>
                        <div class="alert alert-warning text-center">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <h5>Belum Ada Riwayat Diagnosis</h5>
                            <p>Silakan lakukan diagnosis terlebih dahulu.</p>
                            <?= Html::a('<i class="fas fa-stethoscope"></i> Mulai Diagnosis', ['index'], [
                                'class' => 'btn btn-primary mt-2'
                            ]) ?>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th><i class="fas fa-calendar-alt"></i> Tanggal</th>
                                        <th><i class="fas fa-user"></i> Nama Pasien</th>
                                        <th><i class="fas fa-calendar"></i> Usia</th>
                                        <th><i class="fas fa-diagnoses"></i> Hasil Diagnosis</th>
                                        <th><i class="fas fa-chart-line"></i> Keparahan</th>
                                        <th><i class="fas fa-tag"></i> Kategori</th>
                                        <th><i class="fas fa-info-circle"></i> Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    foreach ($histories as $history): 
                                        // Tentukan warna badge berdasarkan kategori
                                        $badgeClass = 'secondary';
                                        if ($history->severity_category == 'Ringan') $badgeClass = 'success';
                                        elseif ($history->severity_category == 'Sedang') $badgeClass = 'warning';
                                        elseif ($history->severity_category == 'Parah') $badgeClass = 'danger';
                                        elseif ($history->severity_category == 'Sangat Parah') $badgeClass = 'dark';
                                        
                                        // Progress bar color
                                        $progressClass = 'bg-success';
                                        if ($history->severity_percentage > 25) $progressClass = 'bg-warning';
                                        if ($history->severity_percentage > 50) $progressClass = 'bg-danger';
                                        if ($history->severity_percentage > 75) $progressClass = 'bg-dark';
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td style="white-space: nowrap;">
                                                <?= Yii::$app->formatter->asDatetime($history->created_at, 'php:d/m/Y H:i') ?>
                                            </td>
                                            <td><?= Html::encode($history->patient_name) ?></td>
                                            <td class="text-center"><?= $history->patient_age ?> th</td>
                                            <td>
                                                <strong><?= Html::encode($history->diagnosis_result) ?></strong>
                                            </td>
                                            <td style="width: 150px;">
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar <?= $progressClass ?> progress-bar-striped" 
                                                         style="width: <?= $history->severity_percentage ?>%;">
                                                        <?= $history->severity_percentage ?>%
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?= $badgeClass ?> p-2">
                                                    <?= $history->severity_category ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" 
                                                        class="btn btn-sm btn-info btn-detail" 
                                                        data-id="<?= $history->id ?>"
                                                        data-name="<?= Html::encode($history->patient_name) ?>"
                                                        data-age="<?= $history->patient_age ?>"
                                                        data-diagnosis="<?= Html::encode($history->diagnosis_result) ?>"
                                                        data-percentage="<?= $history->severity_percentage ?>"
                                                        data-category="<?= $history->severity_category ?>"
                                                        data-symptoms="<?= Html::encode($history->selected_symptoms) ?>"
                                                        data-date="<?= Yii::$app->formatter->asDatetime($history->created_at, 'php:d/m/Y H:i') ?>"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#detailModal">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3 text-muted">
                            <small>
                                <i class="fas fa-info-circle"></i> 
                                Menampilkan <?= count($histories) ?> riwayat diagnosis terakhir
                            </small>
                        </div>
                        
                        <div class="text-center mt-4">
                            <?= Html::a('<i class="fas fa-stethoscope"></i> Diagnosis Baru', ['index'], [
                                'class' => 'btn btn-primary'
                            ]) ?>
                            <?= Html::a('<i class="fas fa-print"></i> Cetak Riwayat', '#', [
                                'class' => 'btn btn-secondary',
                                'onclick' => 'window.print();return false;'
                            ]) ?>
                            <?= Html::a('<i class="fas fa-trash-alt"></i> Hapus Semua', '#', [
                                'class' => 'btn btn-danger',
                                'onclick' => 'return confirmDeleteAll();'
                            ]) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-file-medical-alt"></i> Detail Diagnosis
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Tanggal:</th>
                                <td id="detail-date">-</td>
                            </tr>
                            <tr>
                                <th>Nama Pasien:</th>
                                <td id="detail-name">-</td>
                            </tr>
                            <tr>
                                <th>Usia:</th>
                                <td id="detail-age">-</td>
                            </tr>
                            <tr>
                                <th>Hasil Diagnosis:</th>
                                <td id="detail-diagnosis">-</td>
                            </tr>
                            <tr>
                                <th>Tingkat Keparahan:</th>
                                <td id="detail-percentage">-</td>
                            </tr>
                            <tr>
                                <th>Kategori:</th>
                                <td id="detail-category">-</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-light">
                                <strong><i class="fas fa-list"></i> Gejala yang Dipilih</strong>
                            </div>
                            <div class="card-body" id="detail-symptoms" style="max-height: 300px; overflow-y: auto;">
                                -
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-info" onclick="window.print()">Cetak</button>
            </div>
        </div>
    </div>
</div>

<?php
$deleteUrl = Url::to(['diagnosis/delete-all']);

$js = <<<JS
// Fungsi untuk modal detail
$('.btn-detail').click(function() {
    var id = $(this).data('id');
    var name = $(this).data('name');
    var age = $(this).data('age');
    var diagnosis = $(this).data('diagnosis');
    var percentage = $(this).data('percentage');
    var category = $(this).data('category');
    var symptoms = $(this).data('symptoms');
    var date = $(this).data('date');
    
    $('#detail-date').text(date);
    $('#detail-name').text(name);
    $('#detail-age').text(age + ' tahun');
    $('#detail-diagnosis').text(diagnosis);
    $('#detail-percentage').text(percentage + '%');
    
    // Badge warna untuk kategori
    var badgeClass = 'secondary';
    if (category == 'Ringan') badgeClass = 'success';
    else if (category == 'Sedang') badgeClass = 'warning';
    else if (category == 'Parah') badgeClass = 'danger';
    else if (category == 'Sangat Parah') badgeClass = 'dark';
    
    $('#detail-category').html('<span class="badge bg-' + badgeClass + ' p-2">' + category + '</span>');
    
    // Tampilkan gejala
    if (symptoms && symptoms != 'null') {
        try {
            var symptomCodes = JSON.parse(symptoms);
            if (Array.isArray(symptomCodes) && symptomCodes.length > 0) {
                var html = '<ul class="list-group">';
                for (var i = 0; i < symptomCodes.length; i++) {
                    html += '<li class="list-group-item">' + symptomCodes[i] + '</li>';
                }
                html += '</ul>';
                $('#detail-symptoms').html(html);
            } else {
                $('#detail-symptoms').html('<p class="text-muted">Tidak ada data gejala</p>');
            }
        } catch(e) {
            $('#detail-symptoms').html('<p class="text-muted">' + symptoms + '</p>');
        }
    } else {
        $('#detail-symptoms').html('<p class="text-muted">Tidak ada data gejala</p>');
    }
});

// Konfirmasi hapus semua
window.confirmDeleteAll = function() {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Semua riwayat diagnosis akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus semua!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var csrfParam = $('meta[name="csrf-param"]').attr('content');
            
            // Kirim data dengan CSRF token dan konfirmasi
            var data = {};
            data[csrfParam] = csrfToken;
            data['confirm'] = 1;

            $.ajax({
                url: '$deleteUrl',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Terhapus!',
                            response.message,
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat menghapus data',
                        'error'
                    );
                }
            });
        }
    });
    return false;
};
JS;

$this->registerJs($js);
?>

<style>
@media print {
    .btn, .modal, .navbar, .footer, .btn-detail, .btn-primary, .btn-secondary, .btn-danger {
        display: none !important;
    }
    .card-header {
        background-color: #000 !important;
        color: #fff !important;
    }
    table {
        font-size: 12px;
    }
}
</style>