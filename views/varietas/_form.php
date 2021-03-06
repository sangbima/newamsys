<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\components\Datalist;

/* @var $this yii\web\View */
/* @var $model app\models\Varietas */
/* @var $form yii\widgets\ActiveForm */
$datalist = new Datalist;
?>

<div class="varietas-form">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                                echo $form->field($model, 'komoditas_id')->widget(Select2::classname(), [
                                    'data' => $datalist->getListKomoditas(),
                                    'options' => ['placeholder' => 'Varietas ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success btn-raised' : 'btn btn-primary btn-raised']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
