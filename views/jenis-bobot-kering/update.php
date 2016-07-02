<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JenisBobotKering */

$this->title = 'Ubah Jenis Bobot Kering: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Jenis Bobot Kering', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="jenis-bobot-kering-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
