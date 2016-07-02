<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Petani */

$this->title = 'Ubah Petani: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Petani', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="petani-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
