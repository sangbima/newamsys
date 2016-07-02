<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Desakelurahan */

$this->title = 'Tambah Desa/Kelurahan';
$this->params['breadcrumbs'][] = ['label' => 'Desa/Kelurahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desakelurahan-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
