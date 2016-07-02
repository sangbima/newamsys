<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VarietasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Varietas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="varietas-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Varietas', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
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
            'nama',
            'keterangan:ntext',
            [
                'attribute'=>'komoditas_id',
                'value'=>function($data){
                    return $data->komoditas->nama;
                }
            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            ],
        ],
    ]); ?>
</div>
