<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jenis */

$this->title = 'Tambah Jenis';
$this->params['breadcrumbs'][] = ['label' => 'Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-create">
    <?= $this->render('_form', [
        'model' => $model,

    ]) ?>
</div>
