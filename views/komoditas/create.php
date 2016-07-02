<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Komoditas */

$this->title = 'Tambah Komoditas';
$this->params['breadcrumbs'][] = ['label' => 'Komoditas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="komoditas-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
