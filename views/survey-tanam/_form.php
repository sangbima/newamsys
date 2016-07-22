<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
use app\components\Datalist;

/* @var $this yii\web\View */
/* @var $model app\models\SurveyTanam */
/* @var $form yii\widgets\ActiveForm */
$datalist = new Datalist;
?>

<div class="survey-tanam-form">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?php
            $form = ActiveForm::begin([
                'options' => ['class' => 'bs-component'],
                'fieldConfig' => [
                    'options' => ['class' => 'form-group fg-w-margin label-floating'],
                    'template' => "{label}{input}\n{hint}\n{error}",
                ],
                'id'=>$model->formName(),
                'enableAjaxValidation' => true
            ]); ?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                                echo $form->field($model, 'petani_id')->widget(Select2::classname(), [
                                    'data' => $datalist->getListPetani(),
                                    'options' => ['placeholder' => 'Petani ...'],
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
                                        'depends'=>['surveytanam-provinsi_id'],
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
                                        'depends'=>['surveytanam-kabupatenkota_id'],
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
                                        'depends'=>['surveytanam-kecamatan_id'],
                                        'url'=>Url::to(['/data-list/listdesakelurahan']),
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?= $form->field($model, 'luas_lahan')->widget(\yii\widgets\MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' =>  'decimal',
                                    'groupSeparator' => '.',
                                    'autoGroup' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-md-3">
                            <?=$form->field($model, 'luas_unit')->widget(Select2::classname(), [
                                'data' => array('bahu'=>'Bahu', 'm2'=>'M2', 'hektar'=>'Hektar'),
                                'options' => ['placeholder' => 'Luas Unit ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
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
                        <div class="col-md-4">
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
                                        'depends'=>['surveytanam-komoditas_id'],
                                        'url'=>Url::to(['/data-list/listvarietas']),
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-md-4">
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
                                        'depends'=>['surveytanam-varietas_id'],
                                        'url'=>Url::to(['/data-list/listjenis']),
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?= $form->field($model, 'tgl_panen')->widget(DatePicker::classname(),[
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-mm-yyyy'
                                ]
                            ]); ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($model, 'tgl_tanam')->widget(DatePicker::classname(),[
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-mm-yyyy'
                                ]
                            ]); ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($model, 'harga_bibit')->widget(\yii\widgets\MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' =>  'decimal',
                                    'groupSeparator' => '.',
                                    'autoGroup' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($model, 'est_bobot_ton')->widget(\yii\widgets\MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' =>  'decimal',
                                    'groupSeparator' => '.',
                                    'autoGroup' => true
                                ],
                            ]) ?>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <?php //echo $form->field($model, 'picture')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?php //echo $form->field($model, 'proposal_id')->textInput() ?>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= Html::submitButton($model->isNewRecord ? 'Kirim' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-raised btn-success' : 'btn btn-raised btn-primary']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
