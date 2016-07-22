<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SurveyTanamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Survey Tanam';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-tanam-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Survey Tanam', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
    </p>
    <?php } ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'petani_id',
                'value'=>'petani.nama'
            ],
            [
                'attribute'=>'desakelurahan_id',
                'value'=>'desakelurahan.nama'
            ],
            [
                'attribute'=>'kecamatan_id',
                'value'=>'kecamatan.nama'
            ],
            [
                'attribute'=>'kabupatenkota_id',
                'value'=>'kabupatenkota.nama'
            ],
            [
                'attribute'=>'provinsi_id',
                'value'=>'provinsi.nama'
            ],
            // 'luas_lahan',
            // 'luas_unit',
            [
                'attribute'=>'luas_m2',
                'value'=>function($d) {
                    return Yii::$app->formatter->format($d->luas_m2, 'decimal');
                }
            ],
            // 'komoditas_id',
            // 'varietas_id',
            // 'jenis_id',
            // 'tgl_panen',
            // 'tgl_tanam',
            // 'harga_bibit',
            // 'est_bobot_ton',
            // 'picture',
            // 'proposal_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
