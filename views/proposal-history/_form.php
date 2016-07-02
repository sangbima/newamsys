<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProposalHistory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proposal-history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_proposal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'petani_id')->textInput() ?>

    <?= $form->field($model, 'provinsi_id')->textInput() ?>

    <?= $form->field($model, 'kabupatenkota_id')->textInput() ?>

    <?= $form->field($model, 'kecamatan_id')->textInput() ?>

    <?= $form->field($model, 'desakelurahan_id')->textInput() ?>

    <?= $form->field($model, 'luas_lahan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'luas_unit')->dropDownList([ 'bahu' => 'Bahu', 'hektar' => 'Hektar', 'm2' => 'M2', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'luas_m2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'komoditas_id')->textInput() ?>

    <?= $form->field($model, 'varietas_id')->textInput() ?>

    <?= $form->field($model, 'jenis_id')->textInput() ?>

    <?= $form->field($model, 'tgl_panen')->textInput() ?>

    <?= $form->field($model, 'tgl_tanam')->textInput() ?>

    <?= $form->field($model, 'lapak_prov_id')->textInput() ?>

    <?= $form->field($model, 'lapak_kabkota_id')->textInput() ?>

    <?= $form->field($model, 'lapak_kec_id')->textInput() ?>

    <?= $form->field($model, 'lapak_desakel_id')->textInput() ?>

    <?= $form->field($model, 'est_bobot_basah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'est_bobot_kering')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_bobot_kering_id')->textInput() ?>

    <?= $form->field($model, 'biaya_tebas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'biaya_proses')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pasar_tag_id')->textInput() ?>

    <?= $form->field($model, 'est_tgl_kirim')->textInput() ?>

    <?= $form->field($model, 'kapasitas_pasar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kapasitas_periode')->dropDownList([ 'minggu' => 'Minggu', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'pasar_id')->textInput() ?>

    <?= $form->field($model, 'est_harga_jual')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'biaya_kirim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prop_kadaluarsa')->textInput() ?>

    <?= $form->field($model, 'setuju_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'setuju_alasan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'setuju_berkas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'versi')->textInput() ?>

    <?= $form->field($model, 'proposal_id')->textInput() ?>

    <?= $form->field($model, 'log_time')->textInput() ?>

    <?= $form->field($model, 'picture')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
