<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Varietas */

$this->title = 'Ubah Varietas: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Varietas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->nama]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="varietas-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
