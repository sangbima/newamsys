<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InfoHarga */

$this->title = 'Ubah Info Harga: ' . $model->pasar;
$this->params['breadcrumbs'][] = ['label' => 'Info Harga', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pasar, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="info-harga-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
