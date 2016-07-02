<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InfoHargaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Info Hargas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-harga-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Info Harga', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
    </p>
    <?php } ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'komoditas_id',
                'value'=>'komoditas.nama',
            ],
            [
                'attribute' => 'tanggal',
                'value' => function($d) {
                    return Yii::$app->formatter->format($d->tanggal, 'date');
                }
            ],
            'harga_kg',
            'pasar',
            'sumber',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            ],
        ],
    ]); ?>
</div>
