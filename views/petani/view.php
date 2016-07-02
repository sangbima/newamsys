<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\Petani */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Petani', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="petani-view">

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
            // 'id',
            // 'created_at',
            // 'updated_at',
            // 'user_id',
            // 'latitude',
            // 'longitude',
            'nama',
            'no_ktp',
            'alamat',
            'no_telp',
            [
                'attribute'=>'desakelurahan_id',
                'label'=>'Desa Keluarahan',
                'value'=>$model->desakelurahan->nama
            ],
            [
                'attribute'=>'kecamatan_id',
                'label'=>'Kecamatan',
                'value'=>$model->kecamatan->nama
            ],
            [
                'attribute'=>'kabupatenkota_id',
                'label'=>'Kabupaten Kota',
                'value'=>$model->kabupatenkota->nama
            ],
            [
                'value'=>$model->provinsi->nama,
                'attribute'=>'provinsi_id',
                'label'=>'Provinsi'
            ],
            'keterangan:ntext',
        ],
    ]) ?>

</div>
