<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\LapakProses */
/* @var $form yii\widgets\ActiveForm */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-karung").each(function(index) {
        jQuery(this).html("Karung: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-karung").each(function(index) {
        jQuery(this).html("Karung: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>

<div class="lapak-proses-form">

    <div class="komoditas-form">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php $form = ActiveForm::begin([
                    'options' => ['class' => 'bs-component'],
                    'id' => 'dynamic-form',
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
                                <?php
                                    echo $form->field($model, 'proposal_id')->widget(Select2::classname(), [
                                        'data' => $model->proposalNo,
                                        'options' => ['placeholder' => 'Proposal ...'],
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
                        <?php DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                            'widgetBody' => '.container-items', // required: css class selector
                            'widgetItem' => '.item', // required: css class
                            // 'limit' => 4, // the maximum times, an element can be cloned (default 999)
                            'min' => 1, // 0 or 1 (default 1)
                            'insertButton' => '.add-item', // css class
                            'deleteButton' => '.remove-item', // css class
                            'model' => $modelsLapakKarung[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'lapak_proses_id',
                                'bobot_kg'
                            ],
                        ]); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <button type="button" class="pull-right add-item btn btn-success btn-xs btn-raised"><i class="fa fa-plus"></i> Karung</button>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body container-items">
                                        <?php foreach ($modelsLapakKarung as $index => $modelLapakKarung): ?>
                                            <div class="item panel panel-default"><!-- widgetBody -->
                                                <span class="panel-title-karung">Karung: <?= ($index + 1) ?></span>
                                                <button type="button" class="pull-right btn btn-danger remove-item"><i class="fa fa-minus"></i></button>
                                                <div class="clearfix"></div>
                                                <div class="panel-body with-top-border">
                                                    <?php
                                                        // necessary for update action.
                                                        if (!$modelLapakKarung->isNewRecord) {
                                                            echo Html::activeHiddenInput($modelLapakKarung, "[{$index}]id");
                                                        }
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <?= $form->field($modelLapakKarung, "[{$index}]bobot_kg")->textInput(['maxlength' => true]) ?>
                                                        </div>
                                                    </div><!-- end:row -->
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success btn-raised' : 'btn btn-primary btn-raised']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
