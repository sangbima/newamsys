<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArmadaKirimSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Armada Kirim';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armada-kirim-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Armada', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
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
            // 'status',
            [
                'attribute'=>'proposal_id',
                'value'=>'proposal.no_proposal'
            ],
            // 'lapak_proses_id',
            [
                'attribute'=>'pasar_tag_id',
                'value'=>'pasarTag.nama'
            ],
            // 'kode_kiriman',
            'no_armada',
            'no_polisi',
            'pengemudi',
            // 'keterangan:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
