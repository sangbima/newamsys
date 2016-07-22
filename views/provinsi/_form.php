<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Provinsi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provinsi-form">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'bs-component'],
                'fieldConfig' => [
                    'options' => ['class' => 'form-group fg-w-margin label-floating'],
                    'template' => "{label}{input}\n{hint}\n{error}",
                ],
                'enableAjaxValidation' => true
            ]); ?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?= Html::submitButton($model->isNewRecord ? 'Kirim' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-raised btn-success' : 'btn btn-raised btn-primary']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
