<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArmadaTracking */

$this->title = 'Update Armada Tracking: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Armada Trackings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="armada-tracking-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
