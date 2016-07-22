<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArmadaKirimSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Armada Kirims';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armada-kirim-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Armada Kirim', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'status',
            // 'proposal_id',
            // 'lapak_proses_id',
            // 'pasar_tag_id',
            // 'kode_kiriman',
            // 'no_armada',
            // 'no_polisi',
            // 'pengemudi',
            // 'keterangan:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
