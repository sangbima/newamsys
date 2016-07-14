<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PasarInfoHarianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pasar Info Harian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasar-info-harian-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Pasar Info Harian', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
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
            // 'latitude',
            // 'longitude',
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
            'harga_jual_kg',
            // 'keterangan:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
