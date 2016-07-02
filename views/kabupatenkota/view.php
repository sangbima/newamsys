<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\Kabupatenkota */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Kabupaten/Kota', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kabupatenkota-view">

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

            'kode',
            'nama',
            'tipe',
            [   'attribute'=>'provinsi_id',
                'value'=>$model->provinsi->nama],
            'latitude',
            'longitude',
        ],
    ]) ?>

</div>
