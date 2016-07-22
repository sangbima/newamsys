<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
use app\components\Datalist;

/* @var $this yii\web\View */
/* @var $model app\models\PasarPermintaan */
/* @var $form yii\widgets\ActiveForm */
$datalist = new Datalist;
?>

<div class="pasar-permintaan-form">
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
                        <div class="col-md-3">
                            <?php
                                echo $form->field($model, 'pasar_id')->widget(Select2::classname(), [
                                    'data' => $datalist->getListPasar(),
                                    'options' => ['placeholder' => 'Pasar ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php
                                echo $form->field($model, 'komoditas_id')->widget(Select2::classname(), [
                                    'data' => $datalist->getListKomoditas(),
                                    'options' => ['placeholder' => 'Komoditas ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php
                                echo $form->field($model, 'varietas_id')->widget(DepDrop::classname(), [
                                    'type'=>DepDrop::TYPE_SELECT2,
                                    'data'=>$datalist->getListVarietas(),
                                    'options' => ['placeholder'=>'Varietas ...'],
                                    'select2Options'=>[
                                      'pluginOptions'=>[
                                        'allowClear'=>true,
                                      ],
                                    ],
                                    'pluginOptions'=>[
                                        'depends'=>['pasarpermintaan-komoditas_id'],
                                        'url'=>Url::to(['/data-list/listvarietas']),
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php
                                echo $form->field($model, 'jenis_id')->widget(DepDrop::classname(), [
                                    'type'=>DepDrop::TYPE_SELECT2,
                                    'data'=>$datalist->getListJenis(),
                                    'options' => ['placeholder'=>'Jenis ...'],
                                    'select2Options'=>[
                                      'pluginOptions'=>[
                                        'allowClear'=>true,
                                      ],
                                    ],
                                    'pluginOptions'=>[
                                        'depends'=>['pasarpermintaan-varietas_id'],
                                        'url'=>Url::to(['/data-list/listjenis']),
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'pemesan')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'kuantitas')->widget(\yii\widgets\MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' =>  'decimal',
                                    'groupSeparator' => '.',
                                    'autoGroup' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'harga_minta')->widget(\yii\widgets\MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' =>  'decimal',
                                    'groupSeparator' => '.',
                                    'autoGroup' => true
                                ],
                            ]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'tanggal_tiba')->widget(DatePicker::classname(),[
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-mm-yyyy'
                                ]
                            ]); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
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
                                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success btn-raised' : 'btn btn-primary btn-raised']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
