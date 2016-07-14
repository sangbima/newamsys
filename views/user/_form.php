<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'bs-component'],
                'fieldConfig' => [
                    'options' => ['class' => 'form-group label-floating'],
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
                            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'disabled' => !$model->isNewRecord,]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'disabled' => !$model->isNewRecord,]) ?>
                        </div>
                    </div>
                    <?php if($model->isNewRecord){ ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'newpassword')->passwordInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'newPasswordConfirm')->passwordInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'editPassword')->passwordInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'editPasswordConfirm')->passwordInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'status')->checkbox([
                                'template' => "<div class=\"col-lg-offset-1 col-lg-11\"><div class=\"togglebutton\"><label>{input} {label}</label></div></div>\n<div class=\"col-lg-8\">{error}</div>",
                            ]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= Html::submitButton($model->isNewRecord ? 'Kirim' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-raised btn-success' : 'btn btn-raised btn-primary']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
