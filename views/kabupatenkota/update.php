<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kabupatenkota */

$this->title = 'Ubah Kabupaten Kota: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Kabupaten/Kota', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->nama]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="kabupatenkota-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
