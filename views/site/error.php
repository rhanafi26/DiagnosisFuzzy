<?php
use yii\helpers\Html;

$this->title = $name;
?>

<div class="site-error">
    <div class="alert alert-danger">
        <h4><i class="fas fa-exclamation-triangle"></i> <?= Html::encode($this->title) ?></h4>
        <p><?= nl2br(Html::encode($message)) ?></p>
    </div>
    
    <div class="card mt-4">
        <div class="card-body text-center">
            <p>Terjadi kesalahan saat server memproses request Anda.</p>
            <p>Silakan kembali ke <?= Html::a('halaman utama', Yii::$app->homeUrl) ?>.</p>
            <?= Html::a('<i class="fas fa-home"></i> Kembali ke Home', ['site/index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>