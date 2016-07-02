<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pasar */

$this->title = 'Ubah Pasar: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Pasar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="pasar-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
