<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LapakProses */

$this->title = 'Ubah Proses Lapak: ' . $model->proposal->no_proposal;
$this->params['breadcrumbs'][] = ['label' => 'Proses Lapak', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->proposal->no_proposal, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="lapak-proses-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsLapakKarung' => $modelsLapakKarung
    ]) ?>

</div>
