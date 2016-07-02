<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Desakelurahan */

$this->title = 'Ubah Desa/Kelurahan: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Desa/Kelurahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="desakelurahan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
