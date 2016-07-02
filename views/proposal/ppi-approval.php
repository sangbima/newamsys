<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use \kartik\file\FileInput;
?>
<div class="abmi-approval">
    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'bs-component', 'enctype' => 'multipart/form-data'],
                'fieldConfig' => [
                    'options' => ['class' => 'form-group label-floating'],
                    'template' => "{label}{input}\n{hint}\n{error}",
                ],
                'id' => 'ppiApprovalForm',
                'enableAjaxValidation' => true
            ]); ?>
            <div class="row">
                <div class="col-md-6">
                    <?= Html::activeHiddenInput($model, 'setuju_status[BGR]') ?>
                    <?= Html::activeHiddenInput($model, 'setuju_status[ABMI]') ?>
                    <?= $form->field($model, 'setuju_status[PPI]')->inline()->radioList(array('Pending'=>'Pending','Setuju'=>'Setuju', 'Tolak'=>'Tolak')); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= Html::activeHiddenInput($model, 'setuju_alasan[BGR]') ?>
                    <?= Html::activeHiddenInput($model, 'setuju_alasan[ABMI]') ?>
                    <?= $form->field($model, 'setuju_alasan[PPI]')->textArea(['row' => 6]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?=$form->field($model, 'setuju_berkas[PPI]')->widget(FileInput::classname(), [
                        'pluginOptions' => [
                            'browseClass' => 'btn btn-raised',
                            'showPreview' => false,
                            'showCaption' => true,
                            'showRemove' => true,
                            'showUpload' => false
                        ]
                    ]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= Html::submitButton('Kirim', ['class' => 'btn btn-raised btn-success']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
