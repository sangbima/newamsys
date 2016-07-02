<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Komoditas */

$this->title = 'Ubah Komoditas: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Komoditas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="komoditas-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
