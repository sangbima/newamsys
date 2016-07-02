<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PasarTag */

$this->title = 'Tambah Pasar Tag';
$this->params['breadcrumbs'][] = ['label' => 'Pasar Tag', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasar-tag-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
