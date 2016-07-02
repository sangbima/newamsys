<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PetaniSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Petani';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="petani-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Petani', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
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
            // 'latitude',
            // 'longitude',
            'nama',
            // 'no_ktp',
            'alamat',
            'no_telp',
            // 'keterangan:ntext',
            [
                'attribute'=>'desakelurahan_id',
                'value'=>function($data){
                    return $data->desakelurahan->nama;
                }
            ],
            [
                'attribute'=>'kecamatan_id',
                'value'=>function($data){
                    return $data->kecamatan->nama;
                }
            ],
            [
                'attribute'=>'kabupatenkota_id',
                'value'=>function($data){
                    return $data->kabupatenkota->nama;
                }
            ],
            [
                'attribute'=>'provinsi_id',
                'value'=>function($data){
                    return $data->provinsi->nama;
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            ],
        ],
    ]); ?>
</div>
