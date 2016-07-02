<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PasarPermintaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pasar Permintaan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasar-permintaan-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Pasar Permintaan', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
    </p>
    <?php } ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'created_at',
            // 'updated_at',
            // 'user_id',
            [
                'attribute'=>'pasar_id',
                'value'=>'pasar.nama'
            ],
            [
                'attribute'=>'komoditas_id',
                'value'=>'komoditas.nama'
            ],
            [
                'attribute'=>'varietas_id',
                'value'=>'varietas.nama'
            ],
            [
                'attribute'=>'jenis_id',
                'value'=>'jenis.nama'
            ],
            'pemesan',
            'kuantitas',
            'harga_minta',
            [
                'attribute' => 'tanggal_tiba',
                'value' => function($d) {
                    return Yii::$app->formatter->format($d->tanggal_tiba, 'date');
                }
            ],
            // 'keterangan:ntext',
            // 'latitude',
            // 'longitude',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            ],
        ],
    ]); ?>
</div>
