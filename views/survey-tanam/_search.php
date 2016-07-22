<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SurveyTanamSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="survey-tanam-search">

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

    <?php // echo $form->field($model, 'petani_id') ?>

    <?php // echo $form->field($model, 'provinsi_id') ?>

    <?php // echo $form->field($model, 'kabupatenkota_id') ?>

    <?php // echo $form->field($model, 'kecamatan_id') ?>

    <?php // echo $form->field($model, 'desakelurahan_id') ?>

    <?php // echo $form->field($model, 'luas_lahan') ?>

    <?php // echo $form->field($model, 'luas_unit') ?>

    <?php // echo $form->field($model, 'luas_m2') ?>

    <?php // echo $form->field($model, 'komoditas_id') ?>

    <?php // echo $form->field($model, 'varietas_id') ?>

    <?php // echo $form->field($model, 'jenis_id') ?>

    <?php // echo $form->field($model, 'tgl_panen') ?>

    <?php // echo $form->field($model, 'tgl_tanam') ?>

    <?php // echo $form->field($model, 'harga_bibit') ?>

    <?php // echo $form->field($model, 'est_bobot_ton') ?>

    <?php // echo $form->field($model, 'picture') ?>

    <?php // echo $form->field($model, 'proposal_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
