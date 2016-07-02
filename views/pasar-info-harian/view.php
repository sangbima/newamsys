<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\PasarInfoHarian */

$this->title = $model->pasar->nama;
$this->params['breadcrumbs'][] = ['label' => 'Pasar Info Harian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasar-info-harian-view">

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
                'value' => $model->pasar->nama,
            ],
            [
                'attribute'=>'komoditas_id',
                'value'=>$model->komoditas->nama
            ],
            [
                'attribute'=>'varietas_id',
                'value'=>$model->varietas->nama
            ],
            'harga_jual_kg',
            'keterangan:ntext',
            'latitude',
            'longitude',
        ],
    ]) ?>

</div>
