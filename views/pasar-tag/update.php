<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PasarTag */

$this->title = 'Ubah Pasar Tag: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Pasar Tag', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="pasar-tag-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
