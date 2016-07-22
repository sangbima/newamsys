<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\components\Datalist;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Komoditas */
/* @var $form yii\widgets\ActiveForm */
$datalist = new Datalist;
?>

<div class="komoditas-form">
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
                                // echo $form->field($model, 'penanggungjawab')->widget(Select2::classname(), [
                                //     'data' => $datalist->getKecamatanList(),
                                //     'options' => ['multiple' => true, 'placeholder' => 'Kecamatan ...'],
                                //     'pluginOptions' => [
                                //         'allowClear' => true
                                //     ],
                                // ]);
                            ?>
                            <?= $form->field($model, 'penanggungjawab')->textInput(['maxlength' => true])->label('Penangung Jawab') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
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
