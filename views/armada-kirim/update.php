<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArmadaKirim */

$this->title = 'Ubah Armada: ' . $model->no_polisi;
$this->params['breadcrumbs'][] = ['label' => 'Armada Kirim', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_polisi, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="armada-kirim-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
