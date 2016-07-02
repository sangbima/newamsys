<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PasarInfoHarian */

$this->title = 'Ubah Pasar Info Harian: ' . $model->pasar->nama;
$this->params['breadcrumbs'][] = ['label' => 'Pasar Info Harian', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pasar->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="pasar-info-harian-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
