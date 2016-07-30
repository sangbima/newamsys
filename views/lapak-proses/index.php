<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LapakProsesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proses Lapak';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lapak-proses-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Proses Lapak', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
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
                'attribute'=>'proposal_id',
                'value'=>'proposal.no_proposal'
            ],
            'bobot_muat_kg',
            'jumlah_karung',
            // 'keterangan:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
