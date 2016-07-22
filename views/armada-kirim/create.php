<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ArmadaKirim */

$this->title = 'Create Armada Kirim';
$this->params['breadcrumbs'][] = ['label' => 'Armada Kirims', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armada-kirim-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
