<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LapakKarungSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lapak Karungs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lapak-karung-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lapak Karung', ['create'], ['class' => 'btn btn-success']) ?>
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
            'lapak_proses_id',
            // 'bobot_kg',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
