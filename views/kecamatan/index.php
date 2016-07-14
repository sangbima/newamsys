<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KecamatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kecamatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kecamatan-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Kecamatan', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
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
            'kode',
            'nama',
            [
                'attribute'=>'kabupatenkota_id',
                'value'=> function($data){
                    return $data->kabupatenkota->nama;
                }
            ],
            // 'latitude',
            // 'longitude',


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
