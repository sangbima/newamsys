<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\LapakProses */

$this->title = $model->proposal->no_proposal;
$this->params['breadcrumbs'][] = ['label' => 'Proses Lapak', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lapak-proses-view">

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
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No. Proposal</th>
                                <th>Bobot (Kg)</th>
                                <th>Jumlah Karung</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?=$model->proposal->no_proposal?></td>
                                <td><?=$model->bobot_muat_kg?></td>
                                <td><?=$model->jumlah_karung?></td>
                                <td><?=$model->latitude?></td>
                                <td><?=$model->longitude?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute'=>'keterangan',
                                'format' => 'ntext',
                                'value' => $model->keterangan
                            ],
                        ],
                    ]) ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Bobot (Kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($modelsLapakKarung as $key => $modelLapakKarung): ?>
                            <tr>
                                <td>Karung <?=$key+1?></td>
                                <td><?=$modelLapakKarung->bobot_kg?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
