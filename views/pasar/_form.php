<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
use app\components\Lokasi;
use app\components\Datalist;
use app\models\PasarTag;


/* @var $this yii\web\View */
/* @var $model app\models\Pasar */
/* @var $form yii\widgets\ActiveForm */
$datalist = new Datalist;
?>



<div class="pasar-form">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'no_telp')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                                echo $form->field($model, 'pasar_tag_id')->widget(Select2::classname(), [
                                    'data' => $datalist->getListPasarTag(),
                                    'options' => ['placeholder' => 'Pasar Tag ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
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
                        <div class="col-md-3">
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
                                        'depends'=>['pasar-provinsi_id'],
                                        'url'=>Url::to(['/data-list/listkotakab']),
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-md-3">
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
                                        'depends'=>['pasar-kabupatenkota_id'],
                                        'url'=>Url::to(['/data-list/listkecamatan']),
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-md-3">
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
                                        'depends'=>['pasar-kecamatan_id'],
                                        'url'=>Url::to(['/data-list/listdesakelurahan']),
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
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
