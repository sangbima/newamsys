<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DesakelurahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Desa/Kelurahan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desakelurahan-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Desa/Kelurahan', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
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
            'kode',
            'nama',
            'tipe',
            [
                'attribute'=>'kecamatan_id',
                'value'=>function($data){
                    return $data->kecamatan->nama;
                },
            ],
            // 'latitude',
            // 'longitude',


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            ],
        ],
    ]); ?>
</div>
