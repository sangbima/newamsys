<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PasarPermintaan */

$this->title = 'Ubah Pasar Permintaan: ' . $model->pasar->nama;
$this->params['breadcrumbs'][] = ['label' => 'Pasar Permintaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pasar->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="pasar-permintaan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
