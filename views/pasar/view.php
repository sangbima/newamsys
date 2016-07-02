<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\Pasar */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Pasar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasar-view">

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
            'nama',
            'alamat',
            'no_telp',
            'keterangan:ntext',
            [
                'attribute'=>'desakelurahan_id',
                'value'=>$model->desakelurahan->nama,
            ],
            [
                'attribute'=>'kecamatan_id',
                'value'=>$model->kecamatan->nama
            ],
            [
                'attribute'=>'kabupatenkota_id',
                'value'=>$model->kabupatenkota->nama,
            ],
            [
                'attribute'=>'provinsi_id',
                'value'=>$model->provinsi->nama,
            ],
            [
                'attribute'=>'pasar_tag_id',
                'value'=>$model->pasarTag->nama
            ],
            'latitude',
            'longitude',
        ],
    ]) ?>

</div>
