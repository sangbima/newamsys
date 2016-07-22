<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SurveyTanam */

$this->title = 'Tambah Survey Tanam';
$this->params['breadcrumbs'][] = ['label' => 'Survey Tanam', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-tanam-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
