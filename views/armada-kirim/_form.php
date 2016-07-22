<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArmadaKirim */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="armada-kirim-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'PROCESS' => 'PROCESS', 'FINISH' => 'FINISH', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'proposal_id')->textInput() ?>

    <?= $form->field($model, 'lapak_proses_id')->textInput() ?>

    <?= $form->field($model, 'pasar_tag_id')->textInput() ?>

    <?= $form->field($model, 'kode_kiriman')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_armada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_polisi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengemudi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
