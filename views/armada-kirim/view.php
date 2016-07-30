<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\ArmadaKirim */

$this->title = $model->no_polisi;
$this->params['breadcrumbs'][] = ['label' => 'Armada Kirim', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armada-kirim-view">
    <div class="row">
        <div class="col-md-12">
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-info"></i> Armada Kirim</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No. Proposal</th>
                                <th>Wilayah</th>
                                <th>No. Polisi</th>
                                <th>Pengemudi</th>
                                <th>Bobot Angkut (Kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?=$model->proposal->no_proposal?></td>
                                <td><?=$model->pasarTag->nama;?></td>
                                <td><?=$model->no_polisi;?></td>
                                <td><?=$model->pengemudi?></td>
                                <td><?=$model->lapakProses->bobot_muat_kg;?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-bars"></i> Armada Tracking</div>
                <div class="panel-body">
                    <table class="table table-bordered detail-view">
                        <thead>
                            <tr>
                                <th>Kode Kiriman</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?=$model->kode_kiriman;?></td>
                                <td><?=$model->latitude;?></td>
                                <td><?=$model->longitude;?></td>
                                <td><?=$model->status;?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
