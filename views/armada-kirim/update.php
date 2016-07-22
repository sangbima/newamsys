<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArmadaKirim */

$this->title = 'Update Armada Kirim: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Armada Kirims', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="armada-kirim-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
