<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PasarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pasar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasar-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Pasar', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
    </p>
    <?php } ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'created_at',
            // 'updated_at',
            // 'user_id',
            'nama',
            'alamat',
            'no_telp',
            // 'latitude',
            // 'longitude',
            // 'keterangan:ntext',
            [
                'attribute'=>'desakelurahan_id',
                'value'=>'desakelurahan.nama'
            ],
            [
                'attribute'=>'kecamatan_id',
                'value'=>'kecamatan.nama'
            ],
            [
                'attribute'=>'kabupatenkota_id',
                'value'=>'kabupatenkota.nama'
            ],
            [
                'attribute'=>'provinsi_id',
                'value'=>'provinsi.nama'
            ],
            [
                'attribute'=>'pasar_tag_id',
                'value'=>'pasarTag.nama'
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
