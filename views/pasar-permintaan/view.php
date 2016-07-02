<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\PasarPermintaan */

$this->title = $model->pemesan;
$this->params['breadcrumbs'][] = ['label' => 'Pasar Permintaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasar-permintaan-view">

    <p>
        <?php if(Helper::checkRoute('update')){ ?>
        <?= Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-raised btn-primary']) ?>
        <?php } ?>
        <?php if(Helper::checkRoute('delete')){ ?>
        <?= Html::a('<i class="fa fa-trash" aria-hidden="true"></i> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-raised btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'pasar_id',
                'value'=>$model->pasar->nama,
            ],
            [
                'attribute'=>'komoditas_id',
                'value'=>$model->komoditas->nama
            ],
            [
                'attribute'=>'varietas_id',
                'value'=>$model->varietas->nama
            ],
            [
                'attribute'=>'jenis_id',
                'value'=>$model->jenis->nama
            ],
            'pemesan',
            'kuantitas',
            'harga_minta',
            [
                'attribute'=>'tanggal_tiba',
                'value'=>Yii::$app->formatter->format($model->tanggal_tiba, 'date')
            ],
            'keterangan:ntext',
            'latitude',
            'longitude',
        ],
    ]) ?>

</div>
