<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\SurveyTanam */

$this->title = $model->petani->nama;
$this->params['breadcrumbs'][] = ['label' => 'Survey Tanam', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-tanam-view">

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
            [
                'attribute'=>'petani_id',
                'value'=>$model->petani->nama
            ],
            [
                'attribute'=>'desakelurahan_id',
                'value'=>$model->desakelurahan->nama
            ],
            [
                'attribute'=>'kecamatan_id',
                'value'=>$model->kecamatan->nama
            ],
            [
                'attribute'=>'kabupatenkota_id',
                'value'=>$model->kabupatenkota->nama
            ],
            [
                'attribute'=>'provinsi_id',
                'value'=>$model->provinsi->nama
            ],
            [
                'attribute'=>'luas_lahan',
                'value'=>Yii::$app->formatter->format($model->luas_lahan, 'decimal')
            ],
            'luas_unit',
            [
                'attribute'=>'luas_m2',
                'value'=>Yii::$app->formatter->format($model->luas_m2, 'decimal')
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
            [
                'attribute'=>'tgl_panen',
                'value'=>Yii::$app->formatter->format($model->tgl_panen, 'date')
            ],
            [
                'attribute'=>'tgl_tanam',
                'value'=>Yii::$app->formatter->format($model->tgl_tanam, 'date')
            ],
            [
                'attribute'=>'harga_bibit',
                'value'=>Yii::$app->formatter->format($model->harga_bibit, 'decimal')
            ],
            [
                'attribute'=>'est_bobot_ton',
                'value'=>Yii::$app->formatter->format($model->est_bobot_ton, 'decimal')
            ],
            // 'picture',
            // 'proposal_id',
            'latitude',
            'longitude',
        ],
    ]) ?>

</div>
