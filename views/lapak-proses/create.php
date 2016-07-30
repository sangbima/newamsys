<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LapakProses */

$this->title = 'Tambah Proses Lapak';
$this->params['breadcrumbs'][] = ['label' => 'Proses Lapak', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lapak-proses-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsLapakKarung' => $modelsLapakKarung
    ]) ?>

</div>
