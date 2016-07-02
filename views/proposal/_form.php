<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
use app\components\Datalist;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Proposal */
/* @var $form yii\widgets\ActiveForm */

$datalist = new Datalist;
?>

<div class="proposal-form">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?php
            Pjax::begin(['id' => 'formAddProposal']);
            $form = ActiveForm::begin([
                'options' => ['class' => 'bs-component'],
                'fieldConfig' => [
                    'options' => ['class' => 'form-group label-floating'],
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
                                    'disabled' => !$model->isNewRecord,
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <span class="input-group-btn">
                                <?= Html::a('<i class="fa fa-plus" id="plus-plus"></i><div class="ripple-container"></div>',
                                ['/petani/create-from-proposal'], [
                                    'class' => 'btn btn-fab btn-fab-mini', 'id' => 'btnAddPetani',
                                    'data-toggle' => "modal",
                                    'data-target' => "#addPetani",
                                    'data-title' => "Form Petani"
                                ]) ?>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?php
                                echo $form->field($model, 'provinsi_id')->widget(Select2::classname(), [
                                    'data' => $datalist->getProvinceList(),
                                    'options' => ['placeholder' => 'Provinsi ...'],
                                    'disabled' => !$model->isNewRecord,
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
                                        'depends'=>['proposal-provinsi_id'],
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
                                        'depends'=>['proposal-kabupatenkota_id'],
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
                                        'depends'=>['proposal-kecamatan_id'],
                                        'url'=>Url::to(['/data-list/listdesakelurahan']),
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'luas_lahan')->widget(\yii\widgets\MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' =>  'decimal',
                                    'groupSeparator' => '.',
                                    'autoGroup' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-md-6">
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
                                    'disabled' => !$model->isNewRecord,
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
                                        'depends'=>['proposal-komoditas_id'],
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
                                        'depends'=>['proposal-varietas_id'],
                                        'url'=>Url::to(['/data-list/listjenis']),
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'tgl_panen')->widget(DatePicker::classname(),[
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-mm-yyyy'
                                ]
                            ]); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'tgl_tanam')->widget(DatePicker::classname(),[
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-mm-yyyy'
                                ]
                            ]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'est_bobot_basah')->widget(\yii\widgets\MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' =>  'decimal',
                                    'groupSeparator' => '.',
                                    'autoGroup' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'est_bobot_kering')->widget(\yii\widgets\MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' =>  'decimal',
                                    'groupSeparator' => '.',
                                    'autoGroup' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?php
                                echo $form->field($model, 'jenis_bobot_kering_id')->widget(Select2::classname(), [
                                    'data' => $datalist->getListJenisBobotKering(),
                                    'options' => ['placeholder' => 'Jenis Bobot Kering ...'],
                                    'disabled' => !$model->isNewRecord,
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'biaya_tebas')->widget(\yii\widgets\MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' =>  'decimal',
                                    'groupSeparator' => '.',
                                    'autoGroup' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'biaya_proses')->widget(\yii\widgets\MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' =>  'decimal',
                                    'groupSeparator' => '.',
                                    'autoGroup' => true
                                ],
                            ]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?php
                                echo $form->field($model, 'lapak_prov_id')->widget(Select2::classname(), [
                                    'data' => $datalist->getProvinceList(),
                                    'options' => ['placeholder' => 'Lapak Provinsi ...'],
                                    'disabled' => !$model->isNewRecord,
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php
                                echo $form->field($model, 'lapak_kabkota_id')->widget(DepDrop::classname(), [
                                    'type'=>DepDrop::TYPE_SELECT2,
                                    'data'=>$datalist->getKabupatenKotaList(),
                                    'options' => ['placeholder'=>'Lapak Kabupaten/Kota ...'],
                                    'select2Options'=>[
                                      'pluginOptions'=>[
                                        'allowClear'=>true,
                                      ],
                                    ],
                                    'pluginOptions'=>[
                                        'depends'=>['proposal-lapak_prov_id'],
                                        'url'=>Url::to(['/data-list/listkotakab']),
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php
                                echo $form->field($model, 'lapak_kec_id')->widget(DepDrop::classname(), [
                                    'type'=>DepDrop::TYPE_SELECT2,
                                    'data'=>$datalist->getKecamatanList(),
                                    'options' => ['placeholder'=>'Lapak Kecamatan ...'],
                                    'select2Options'=>[
                                      'pluginOptions'=>[
                                        'allowClear'=>true,
                                      ],
                                    ],
                                    'pluginOptions'=>[
                                        'depends'=>['proposal-lapak_kabkota_id'],
                                        'url'=>Url::to(['/data-list/listkecamatan']),
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php
                                echo $form->field($model, 'lapak_desakel_id')->widget(DepDrop::classname(), [
                                    'type'=>DepDrop::TYPE_SELECT2,
                                    'data'=>$datalist->getDesaKelurahanList(),
                                    'options' => ['placeholder'=>'Lapak Desa/Kelurahan ...'],
                                    'select2Options'=>[
                                      'pluginOptions'=>[
                                        'allowClear'=>true,
                                      ],
                                    ],
                                    'pluginOptions'=>[
                                        'depends'=>['proposal-lapak_kec_id'],
                                        'url'=>Url::to(['/data-list/listdesakelurahan']),
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                                echo $form->field($model, 'pasar_tag_id')->widget(Select2::classname(), [
                                    'data' => $datalist->getListPasarTag(),
                                    'options' => ['placeholder' => 'Pasar Tag...'],
                                    'disabled' => !$model->isNewRecord,
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'est_tgl_kirim')->widget(DatePicker::classname(),[
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-mm-yyyy'
                                ]
                            ]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'kapasitas_pasar')->widget(\yii\widgets\MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' =>  'decimal',
                                    'groupSeparator' => '.',
                                    'autoGroup' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?php
                                echo $form->field($model, 'pasar_id')->widget(Select2::classname(), [
                                    'data' => $datalist->getListPasar(),
                                    'options' => ['placeholder' => 'Pasar ...'],
                                    'disabled' => !$model->isNewRecord,
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                            ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'prop_kadaluarsa')->widget(DatePicker::classname(),[
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-mm-yyyy'
                                ]
                            ]); ?>
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
            <?php Pjax::end() ?>
        </div>
    </div>
</div>
<?php
Modal::begin([
    'id' => 'addPetani',
    'size' => 'modal-lg',
]);

echo '...';

Modal::end();

$script = <<< JS

$('#addPetani').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget)
    var modal = $(this)
    var href = button.attr('href')
    modal.find('.modal-body').html('<i class="fa fa-spinner fa-spin></i>"')
    $.post(href)
        .done(function(data){
            modal.find('.modal-body').html(data)
        });
});

JS;
$this->registerJs($script);
?>
