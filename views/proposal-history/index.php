<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProposalHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proposal Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proposal-history-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Proposal History', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            'updated_at',
            'user_id',
            'latitude',
            // 'longitude',
            // 'no_proposal',
            // 'petani_id',
            // 'provinsi_id',
            // 'kabupatenkota_id',
            // 'kecamatan_id',
            // 'desakelurahan_id',
            // 'luas_lahan',
            // 'luas_unit',
            // 'luas_m2',
            // 'komoditas_id',
            // 'varietas_id',
            // 'jenis_id',
            // 'tgl_panen',
            // 'tgl_tanam',
            // 'lapak_prov_id',
            // 'lapak_kabkota_id',
            // 'lapak_kec_id',
            // 'lapak_desakel_id',
            // 'est_bobot_basah',
            // 'est_bobot_kering',
            // 'jenis_bobot_kering_id',
            // 'biaya_tebas',
            // 'biaya_proses',
            // 'pasar_tag_id',
            // 'est_tgl_kirim',
            // 'kapasitas_pasar',
            // 'kapasitas_periode',
            // 'pasar_id',
            // 'est_harga_jual',
            // 'biaya_kirim',
            // 'prop_kadaluarsa',
            // 'setuju_status',
            // 'setuju_alasan:ntext',
            // 'setuju_berkas',
            // 'versi',
            // 'proposal_id',
            // 'log_time',
            // 'picture',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            ],
        ],
    ]); ?>
</div>
