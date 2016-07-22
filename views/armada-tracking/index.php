<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArmadaTrackingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Armada Trackings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armada-tracking-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Armada Tracking', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'armada_kirim_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
