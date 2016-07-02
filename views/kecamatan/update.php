<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kecamatan */

$this->title = 'Ubah Kecamatan: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Kecamatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->nama]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="kecamatan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
