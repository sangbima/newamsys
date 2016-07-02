<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;
use app\components\Konversi;

/* @var $this yii\web\View */
/* @var $model app\models\Proposal */

$this->title = $model->no_proposal;
$this->params['breadcrumbs'][] = ['label' => 'Proposal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" container proposal-view">
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
                <?php if(Helper::checkRoute('pdf')){ ?>
                <?= Html::a('<i class="fa fa-print" aria-hidden="true"></i> Print', ['pdf', 'id' => $model->id], ['target' => '_blank','class' => 'btn btn-raised btn-primary']) ?>
                <?php } ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-info"></i> Proposal</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No. Proposal</th>
                                <th>Tanggal Survey</th>
                                <th>Luas Lahan</th>
                                <th>Luas Unit</th>
                                <th>Luas Lahan (m2)</th>
                                <th>Kadaluarsa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?=$model->no_proposal?></td>
                                <td><?=Yii::$app->formatter->format($model->created_at, 'date');?></td>
                                <td><?=Yii::$app->formatter->format($model->luas_lahan, 'decimal');?></td>
                                <td><?=$model->luas_unit?></td>
                                <td><?=Yii::$app->formatter->format($model->luas_m2, 'decimal');?></td>
                                <td><?=Yii::$app->formatter->format($model->prop_kadaluarsa, 'date');?></td>
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
                <div class="panel-heading"><i class="fa fa-bars"></i> Detail Proposal</div>
                <div class="panel-body">
                    <table class="table table-bordered detail-view">
                        <tr>
                            <th>Nama Petani</th>
                            <td><?=$model->petani->nama?></td>
                        </tr>
                        <tr>
                            <th>Lokasi Lahan</th>
                            <td>
                                <table class="table table-no-border table-condensed">
                                    <tr>
                                        <td>Desa/Kelurahan</td>
                                        <td>:</td>
                                        <td><?=$model->desakelurahan->nama?></td>
                                    </tr>
                                    <tr>
                                        <td>Kecamatan</td>
                                        <td>:</td>
                                        <td><?=$model->kecamatan->nama?></td>
                                    </tr>
                                    <tr>
                                        <td>Kabupaten/kota</td>
                                        <td>:</td>
                                        <td><?=$model->kabupatenkota->nama?></td>
                                    </tr>
                                    <tr>
                                        <td>Provinsi</td>
                                        <td>:</td>
                                        <td><?=$model->provinsi->nama?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>Komoditas</th>
                            <td><?=$model->komoditas->nama?></td>
                        </tr>
                        <tr>
                            <th>Varietas</th>
                            <td><?=$model->varietas->nama?></td>
                        </tr>
                        <tr>
                            <th>Jenis</th>
                            <td><?=$model->jenis->nama?></td>
                        </tr>
                        <tr>
                            <th>Tgl. Panen</th>
                            <td><?=Yii::$app->formatter->format($model->tgl_panen, 'date')?></td>
                        </tr>
                        <tr>
                            <th>Tgl. Tanam</th>
                            <td><?=Yii::$app->formatter->format($model->tgl_tanam, 'date')?></td>
                        </tr>
                        <tr>
                            <th>Lokasi Lapak</th>
                            <td>
                                <table class="table table-no-border table-condensed">
                                    <tr>
                                        <td>Desa/Kelurahan</td>
                                        <td>:</td>
                                        <td><?=$model->lapakDesakel->nama?></td>
                                    </tr>
                                    <tr>
                                        <td>Kecamatan</td>
                                        <td>:</td>
                                        <td><?=$model->lapakKec->nama?></td>
                                    </tr>
                                    <tr>
                                        <td>Kabupaten/kota</td>
                                        <td>:</td>
                                        <td><?=$model->lapakKabkota->nama?></td>
                                    </tr>
                                    <tr>
                                        <td>Provinsi</td>
                                        <td>:</td>
                                        <td><?=$model->lapakProv->nama?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>Est. Bobot Basah (Kg)</th>
                            <td><?=Yii::$app->formatter->format($model->est_bobot_basah, 'decimal')?></td>
                        </tr>
                        <tr>
                            <th>Est. Bobot Kering (Kg)</th>
                            <td><?=Yii::$app->formatter->format($model->est_bobot_kering, 'decimal')?></td>
                        </tr>
                        <tr>
                            <th>Jenis Bobot Kering</th>
                            <td><?=$model->jenisBobotKering->nama?></td>
                        </tr>
                        <tr>
                            <th>Biaya Tebas (Rp)</th>
                            <td><?=Yii::$app->formatter->format($model->biaya_tebas, 'decimal')?></td>
                        </tr>
                        <tr>
                            <th>Biaya Proses (Rp)</th>
                            <td><?=Yii::$app->formatter->format($model->biaya_proses, 'decimal')?></td>
                        </tr>
                        <tr>
                            <th>Pasar Tag</th>
                            <td><?=$model->pasarTag->nama?></td>
                        </tr>
                        <tr>
                            <th>Est. Tgl. Kirim</th>
                            <td><?=Yii::$app->formatter->format($model->est_tgl_kirim, 'date')?></td>
                        </tr>
                        <tr>
                            <th>Kapasitas Pasar (Ton/Minggu)</th>
                            <td><?=Yii::$app->formatter->format($model->kapasitas_pasar, 'decimal')?></td>
                        </tr>
                        <tr>
                            <th>Nama Pasar</th>
                            <td><?=$model->pasar->nama?></td>
                        </tr>
                        <tr>
                            <th>Est. Harga Jual (Rp)</th>
                            <td><?=Yii::$app->formatter->format($model->est_harga_jual, 'decimal')?></td>
                        </tr>
                        <tr>
                            <th>Biaya Kirim (Rp)</th>
                            <td><?=Yii::$app->formatter->format($model->biaya_kirim, 'decimal')?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <table class="table table-no-border table-condensed">
                                    <tr>
                                        <td width="50px">BGR</td>
                                        <td width="10px">:</td>
                                        <td><?=$model->proposalstatus($model->setuju_status['BGR'])?></td>
                                    </tr>
                                    <tr>
                                        <td width="50px">ABMI</td>
                                        <td width="10px">:</td>
                                        <td><?=$model->proposalstatus($model->setuju_status['ABMI'])?></td>
                                    </tr>
                                    <tr>
                                        <td width="50px">PPI</td>
                                        <td width="10px">:</td>
                                        <td><?=$model->proposalstatus($model->setuju_status['PPI'])?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>Alasan</th>
                            <td>
                                <table class="table table-no-border table-condensed">
                                    <tr>
                                        <td width="50px">BGR</td>
                                        <td width="10px">:</td>
                                        <td><?=$model->setuju_alasan['BGR']?></td>
                                    </tr>
                                    <tr>
                                        <td width="50px">ABMI</td>
                                        <td width="10px">:</td>
                                        <td><?=$model->setuju_alasan['ABMI']?></td>
                                    </tr>
                                    <tr>
                                        <td width="50px">PPI</td>
                                        <td width="10px">:</td>
                                        <td><?=$model->setuju_alasan['PPI']?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>Berkas</th>
                            <td>
                                <table class="table table-no-border table-condensed">
                                    <tr>
                                        <td width="50px">BGR</td>
                                        <td width="10px">:</td>
                                        <td><?=$model->setuju_berkas['BGR']?></td>
                                        <td><i class="fa fa-download" aria-hidden="true"></i></td>
                                    </tr>
                                    <tr>
                                        <td width="50px">ABMI</td>
                                        <td width="10px">:</td>
                                        <td><?=$model->setuju_berkas['ABMI']?></td>
                                        <td><i class="fa fa-download" aria-hidden="true"></i></td>
                                    </tr>
                                    <tr>
                                        <td width="50px">PPI</td>
                                        <td width="10px">:</td>
                                        <td><?=$model->setuju_berkas['PPI']?></td>
                                        <td><i class="fa fa-download" aria-hidden="true"></i></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>Latitude</th>
                            <td><?=$model->latitude?></td>
                        </tr>
                        <tr>
                            <th>Longitude</th>
                            <td><?=$model->longitude?></td>
                        </tr>
                        <tr>
                            <th>Versi</th>
                            <td><?=$model->versi?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-calendar"></i> Timeline</div>
                        <div class="panel-body">
                            <div class="timeline">
                                <dl>
                                    <?php  foreach ($tracks as $track) { $i=1;?>
                                        <dt><?=Konversi::indonesiablnthnformat($track['blnthn']) ?></dt>
                                        <?php foreach($track['data'] as $data) {?>
                                            <dd class="<?=$i%2 == 0 ? "pos-right" : "pos-left"?> clearfix <?=$i?>">
                                                <div class="circ"></div>
                                                <div class="time"><?=Konversi::longindonesiadateformat($data['created_at'])?></div>
                                                <div class="events">
                                                    <div class="events-body">
                                                        <?php
                                                            $keterangan = json_decode($data['keterangan'], true);
                                                            if (json_last_error() === JSON_ERROR_NONE) {
                                                        ?>
                                                        <table class="table table-no-border table-condensed">
                                                            <tr>
                                                                <td width="50px">BGR</td>
                                                                <td width="10px">:</td>
                                                                <td><?=$model->proposalstatus($keterangan['BGR'])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="50px">ABMI</td>
                                                                <td width="10px">:</td>
                                                                <td><?=$model->proposalstatus($keterangan['ABMI'])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="50px">PPI</td>
                                                                <td width="10px">:</td>
                                                                <td><?=$model->proposalstatus($keterangan['PPI'])?></td>
                                                            </tr>
                                                        </table>
                                                        <?php
                                                            } else {
                                                        ?>
                                                        <p><?=$data['keterangan']?></p>
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </dd>
                                        <?php $i++;} ?>
                                    <?php }?>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-picture-o"></i> Foto Lahan</div>
                        <div class="panel-body">
                            <?php
                                if (!empty($model->picture)) {
                            ?>
                            <img src="<?=Yii::$app->homeUrl?>uploads/proposal/images/<?=$model->picture?>" class="img-responsive" alt="Foto Lahan Proposal <?=$model->no_proposal?>">
                            <?php
                                } else {
                            ?>
                            <img src="<?=Yii::$app->homeUrl?>images/default-lahan-img.gif" class="img-responsive" alt="Foto Lahan Proposal <?=$model->no_proposal?>">
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
