<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
use app\components\Lokasi;
use app\components\Datalist;

/* @var $this yii\web\View */
/* @var $model app\models\Petani */
/* @var $form yii\widgets\ActiveForm */

$datalist = new Datalist;
?>

<div class="petani-form">
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
                        <div class="col-md-4">
                            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'no_ktp')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'no_telp')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                                echo $form->field($model, 'provinsi_id')->widget(Select2::classname(), [
                                    'data' => $datalist->getProvinceList(),
                                    'options' => ['placeholder' => 'Provinsi ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                                echo $form->field($model, 'kabupatenkota_id')->widget(DepDrop::classname(), [
                                    'type'=>DepDrop::TYPE_SELECT2,
                                    'data'=>$datalist->getKabupatenKotaList(),
                                    'options' => ['placeholder'=>'Kabupaten/Kota ...'],
                                    'select2Options'=>[
                                      'pluginOptions'=>[
                                        'allowClear'=>true,
                                      ],
                                    ],
                                    'pluginOptions'=>[
                                        'depends'=>['petani-provinsi_id'],
                                        'url'=>Url::to(['/data-list/listkotakab']),
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                                echo $form->field($model, 'kecamatan_id')->widget(DepDrop::classname(), [
                                    'type'=>DepDrop::TYPE_SELECT2,
                                    'data'=>$datalist->getKecamatanList(),
                                    'options' => ['placeholder'=>'Kecamatan ...'],
                                    'select2Options'=>[
                                      'pluginOptions'=>[
                                        'allowClear'=>true,
                                      ],
                                    ],
                                    'pluginOptions'=>[
                                        'depends'=>['petani-kabupatenkota_id'],
                                        'url'=>Url::to(['/data-list/listkecamatan']),
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                                echo $form->field($model, 'desakelurahan_id')->widget(DepDrop::classname(), [
                                    'type'=>DepDrop::TYPE_SELECT2,
                                    'data'=>$datalist->getDesaKelurahanList(),
                                    'options' => ['placeholder'=>'Desa/Kelurahan ...'],
                                    'select2Options'=>[
                                      'pluginOptions'=>[
                                        'allowClear'=>true,
                                      ],
                                    ],
                                    'pluginOptions'=>[
                                        'depends'=>['petani-kecamatan_id'],
                                        'url'=>Url::to(['/data-list/listdesakelurahan']),
                                    ]
                                ]);
                            ?>
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
