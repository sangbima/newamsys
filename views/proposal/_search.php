<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProposalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proposal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'no_proposal') ?>

    <?php // echo $form->field($model, 'petani_id') ?>

    <?php // echo $form->field($model, 'provinsi_id') ?>

    <?php // echo $form->field($model, 'kabupatenkota_id') ?>

    <?php // echo $form->field($model, 'kecamatan_id') ?>

    <?php // echo $form->field($model, 'desakelurahan_id') ?>

    <?php // echo $form->field($model, 'luas_lahan') ?>

    <?php // echo $form->field($model, 'luas_unit') ?>

    <?php // echo $form->field($model, 'luas_m2') ?>

    <?php // echo $form->field($model, 'komoditas_id') ?>

    <?php // echo $form->field($model, 'varietas_id') ?>

    <?php // echo $form->field($model, 'jenis_id') ?>

    <?php // echo $form->field($model, 'tgl_panen') ?>

    <?php // echo $form->field($model, 'tgl_tanam') ?>

    <?php // echo $form->field($model, 'lapak_prov_id') ?>

    <?php // echo $form->field($model, 'lapak_kabkota_id') ?>

    <?php // echo $form->field($model, 'lapak_kec_id') ?>

    <?php // echo $form->field($model, 'lapak_desakel_id') ?>

    <?php // echo $form->field($model, 'est_bobot_basah') ?>

    <?php // echo $form->field($model, 'est_bobot_kering') ?>

    <?php // echo $form->field($model, 'jenis_bobot_kering_id') ?>

    <?php // echo $form->field($model, 'biaya_tebas') ?>

    <?php // echo $form->field($model, 'biaya_proses') ?>

    <?php // echo $form->field($model, 'pasar_tag_id') ?>

    <?php // echo $form->field($model, 'est_tgl_kirim') ?>

    <?php // echo $form->field($model, 'kapasitas_pasar') ?>

    <?php // echo $form->field($model, 'kapasitas_periode') ?>

    <?php // echo $form->field($model, 'pasar_id') ?>

    <?php // echo $form->field($model, 'est_harga_jual') ?>

    <?php // echo $form->field($model, 'biaya_kirim') ?>

    <?php // echo $form->field($model, 'prop_kadaluarsa') ?>

    <?php // echo $form->field($model, 'setuju_status') ?>

    <?php // echo $form->field($model, 'setuju_alasan') ?>

    <?php // echo $form->field($model, 'setuju_berkas') ?>

    <?php // echo $form->field($model, 'versi') ?>

    <?php // echo $form->field($model, 'picture') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
