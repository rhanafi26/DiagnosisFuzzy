<?php

use yii\helpers\Html;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Nav;
use yii\bootstrap4\Breadcrumbs;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f5f5f5;
        }
        .wrap {
            min-height: 100vh;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            margin-top: 50px;
            border-top: 1px solid #e9ecef;
        }
        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<i class="fas fa-stethoscope"></i> Diagnosa Penyakit Pencernaan',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-lg navbar-dark bg-primary'],
    ]);
    
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Diagnosa', 'url' => ['/diagnosis/index']],
        ['label' => 'Riwayat', 'url' => ['/diagnosis/history']],
    ];
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => $menuItems,
    ]);
    
    NavBar::end();
    ?>
    
    <div class="container mt-4">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => ['label' => 'Home', 'url' => Yii::$app->homeUrl],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container text-center">
        <p class="text-muted mb-0">
            <i class="fas fa-copyright"></i> Sistem Pakar Diagnosa Penyakit Pencernaan <?= date('Y') ?> | 
            Metode Fuzzy Logic Sugeno
        </p>
        <small class="text-muted">* Hasil diagnosis hanya untuk referensi, konsultasikan dengan dokter untuk kepastian</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>