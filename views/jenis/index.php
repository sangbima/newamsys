<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JenisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jenis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Jenis/Grade', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
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
            'keterangan:ntext',
            [
                'label'=>'Varietas',
                'attribute'=>'varietas_id',
                'value'=>function($data){
                    return $data->varietas->nama;
                }
            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
