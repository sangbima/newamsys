<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProposalHistory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Proposal Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proposal-history-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'user_id',
            'latitude',
            'longitude',
            'no_proposal',
            'petani_id',
            'provinsi_id',
            'kabupatenkota_id',
            'kecamatan_id',
            'desakelurahan_id',
            'luas_lahan',
            'luas_unit',
            'luas_m2',
            'komoditas_id',
            'varietas_id',
            'jenis_id',
            'tgl_panen',
            'tgl_tanam',
            'lapak_prov_id',
            'lapak_kabkota_id',
            'lapak_kec_id',
            'lapak_desakel_id',
            'est_bobot_basah',
            'est_bobot_kering',
            'jenis_bobot_kering_id',
            'biaya_tebas',
            'biaya_proses',
            'pasar_tag_id',
            'est_tgl_kirim',
            'kapasitas_pasar',
            'kapasitas_periode',
            'pasar_id',
            'est_harga_jual',
            'biaya_kirim',
            'prop_kadaluarsa',
            'setuju_status',
            'setuju_alasan:ntext',
            'setuju_berkas',
            'versi',
            'proposal_id',
            'log_time',
            'picture',
        ],
    ]) ?>

</div>
