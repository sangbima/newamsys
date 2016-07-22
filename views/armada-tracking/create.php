<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ArmadaTracking */

$this->title = 'Create Armada Tracking';
$this->params['breadcrumbs'][] = ['label' => 'Armada Trackings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armada-tracking-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
