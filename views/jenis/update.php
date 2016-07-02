<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jenis */

$this->title = 'Ubah Jenis: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->nama]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="jenis-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
