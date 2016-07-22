<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LapakProses */

$this->title = 'Update Lapak Proses: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lapak Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lapak-proses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
