<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PasarPermintaanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pasar-permintaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'pasar_id') ?>

    <?php // echo $form->field($model, 'komoditas_id') ?>

    <?php // echo $form->field($model, 'varietas_id') ?>

    <?php // echo $form->field($model, 'jenis_id') ?>

    <?php // echo $form->field($model, 'pemesan') ?>

    <?php // echo $form->field($model, 'kuantitas') ?>

    <?php // echo $form->field($model, 'harga_minta') ?>

    <?php // echo $form->field($model, 'tanggal_tiba') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
