<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SurveyTanam */

$this->title = 'Ubah Survey Tanam: ' . $model->petani->nama;
$this->params['breadcrumbs'][] = ['label' => 'Survey Tanam', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->petani->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="survey-tanam-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
