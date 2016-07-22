<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LapakProsesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lapak Proses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lapak-proses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lapak Proses', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            'updated_at',
            'user_id',
            'latitude',
            // 'longitude',
            // 'proposal_id',
            // 'bobot_muat_kg',
            // 'jumlah_karung',
            // 'keterangan:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
