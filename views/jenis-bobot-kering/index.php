<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JenisBobotKeringSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jenis Bobot Kering';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-bobot-kering-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Jenis Bobot Kering', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
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
            [
                'label'=>'Komoditas',
                'attribute'=>'komoditas_id',
                'value'=>function($data){
                    return $data->komoditas->nama;
                }],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => Helper::filterActionColumn('{view} {update} {delete}'),
                ],
        ],
    ]); ?>
</div>
