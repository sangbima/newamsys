<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KabupatenkotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kabupaten / Kota';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kabupatenkota-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Kabupaten/Kota', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
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
            // 'latitude',
            // 'longitude',
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
