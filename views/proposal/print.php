<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

use app\assets\AmsysAsset;

AmsysAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body onload="window.print();">
<?php $this->beginBody() ?>
	<div class="proposal-view col-md-offset-1" style="margin-top:15px; margin-bottom: 20px; max-width:1220px; width:100%">
	    <div class="row">   
        <div class="col-md-12"> 

            <table class="table-bordered" width="100%"> 
                <tr>
                    <td class="text-center" colspan="2"><h3 style="font-weight:400">Formulir Tebasan</h3></td>
                </tr>
                <tr>
                    <td class="text-center tdlogo1" colspan="2">
                        <div class="col-md-2 col-md-offset-1">
                            <?= Html::img('@web/images/abmi.png'); ?>
                        </div>
                        <div class="col-md-4 col-md-offset-1">
                            <?= Html::img('@web/images/ppi.png'); ?>
                        </div>
                        <div class="col-md-3 col-md-offset-1">
                            <?= Html::img('@web/images/bgrlogo.png'); ?>
                        </div>
                    </td>
                </tr>
                <tr>    
                    <td class="tdprop" colspan="2">    
                       <p style="font-weight:400">Rincian Formulir</p>
                    </td>
                </tr>
                
                <tr>
                    <td class="tdprop tdnum"><p style="font-weight:500">No</p></td>
                    <td class="tdprop text-center"><p style="font-weight:500">Data Formulir</p></td>
                </tr>

                <tr>    
                    <td class="tdprop tdnum"><p>1</p></td>
                    <td class="tdprop"><p><span style="margin-right:200px">No Formulir</span><span style="margin-right:20px">:</span><span><?= $model->no_proposal; ?></span></p></td>
                </tr>

                <tr>    
                    <td class="tdprop tdnum"><p>2</p></td>
                    <td class="tdprop"><p><span style="margin-right:210px">Tgl Survey</span><span style="margin-right:20px">:</span><span><?= date('d-m-Y', strtotime($model->created_at)); ?></span></p></td>
                </tr>

                <tr>    
                    <td class="tdprop tdnum"><p>3</p></td>
                    <td class="tdprop"><p><span style="margin-right:194px">Nama Petani</span><span style="margin-right:20px">:</span><span><?= $model->petani->nama; ?></span></p></td>
                </tr>
                <tr>    
                    <td class="tdprop tdnum"><p>4</p></td>
                    <td class="tdprop"><p><span style="margin-right:234px">Lokasi</span><span style="margin-right:20px">:</span><span style="margin-right:30px">Desa/Kelurahan : <b><?= $model->desakelurahan->nama; ?></b></span><span style="margin-right:30px">Kecamatan : <b><?= $model->kecamatan->nama; ?></b></span><span>Kota/Kabupaten : <b><?= $model->kabupatenkota->nama; ?></b></span></p></td>
                </tr>
                <tr>    
                    <td class="tdprop tdnum"><p>5</p></td>
                    <td class="tdprop"><p><span style="margin-right:203px">Luas Lahan</span><span style="margin-right:20px">:</span><span><?= $model->luas_lahan.' '.$model->luas_unit; ?></span></p></td>
                </tr>

                <tr>    
                    <td class="tdprop tdnum"><p>6</p></td>
                    <td class="tdprop"><p><span style="margin-right:207px">Komoditas</span><span style="margin-right:20px">:</span><span style="margin-right:30px"><b><?= $model->komoditas->nama; ?></b></span><span style="margin-right:30px">Varietas : <b><?= $model->varietas->nama; ?></b></span><span>Jenis : <b><?= $model->jenis->nama; ?></b></span></p></td>
                </tr>

                <tr>    
                    <td class="tdprop tdnum"><p>7</p></td>
                    <td class="tdprop"><p><span style="margin-right:183px">Tanggal Panen</span><span style="margin-right:20px">:</span><span style="margin-right:30px"><b><?= date('d-m-Y', strtotime($model->tgl_panen)); ?></b></span><span style="margin-left:130px">Tanggal Tanam : <b><?= date('d-m-Y', strtotime($model->tgl_tanam)); ?></b></span></p></td>
                </tr>

                <tr>    
                    <td class="tdprop tdnum"><p>8</p></td>
                    <td class="tdprop"><p><span style="margin-right:132px">Tempat / Lapak Proses</span><span style="margin-right:20px">:</span><span style="margin-right:30px">Desa/Kelurahan : <b><?= $model->lapakDesakel->nama; ?></b></span><span style="margin-right:30px">Kecamatan : <b><?= $model->lapakKec->nama; ?></b></span><span>Kota/Kabupaten : <b><?= $model->lapakKabkota->nama; ?></b></span></p></td>
                </tr>

                <tr>    
                    <td class="tdprop tdnum"><p>9</p></td>
                    <td class="tdprop"><p><span style="margin-right:139px">Estimasi Bobot Basah</span><span style="margin-right:20px">:</span><span style="margin-right:30px"><b><?= ($model->est_bobot_basah/1000).' Ton'; ?></b></span><span style="margin-left:150px">Estimasi Bobot Kering : <b><?= ($model->est_bobot_kering/1000).' Ton'; ?></b></span></p>
                    </td>
                </tr>

                <tr>    
                    <td class="tdprop tdnum"><p>10</p></td>
                    <td class="tdprop"><p><span style="margin-right:200px">Biaya Tebas</span><span style="margin-right:20px">:</span><span style="margin-right:30px"><b><?= 'Rp '.number_format($model->biaya_tebas,0,",",".").' ,-'; ?></b></span><span style="margin-left:120px">Biaya Proses : <b><?= 'Rp '.number_format($model->biaya_proses,0,",",".").' ,-'; ?></b></span></p>
                    </td>
                </tr>

                <tr>    
                    <td class="tdprop tdnum"><p>11</p></td>
                    <td class="tdprop"><p><span style="margin-right:193px">Tujuan Pasar</span><span style="margin-right:20px">:</span><span style="margin-right:30px"><b><?= $model->pasarTag->nama; ?></b></span><span style="margin-left:113px">Est. Tgl Kirim : <b><?= date('d-m-Y', strtotime($model->est_tgl_kirim)); ?></b></span></p>
                    </td>
                </tr>

                <tr>    
                    <td class="tdprop tdnum"><p>12</p></td>
                    <td class="tdprop"><p><span style="margin-right:110px">Refrensi Permintaan (QTY)</span><span style="margin-right:20px">:</span><span style="margin-right:30px"><b><?= $model->kapasitas_pasar; ?> Ton/Minggu</b></span><span style="margin-left:83px">Refrensi Nama Pasar : <b><?= $model->pasar->nama; ?></b></span></p>
                    </td>
                </tr>

                <tr>    
                    <td class="tdprop tdnum"><p>13</p></td>
                    <td class="tdprop"><p><span style="margin-right:96px">Est. Harga Penjualan (Rp/Kg)</span><span style="margin-right:20px">:</span><span style="margin-right:30px"><b><?= 'Rp '.number_format($model->est_harga_jual,0,",",".").' ,-'; ?> /Kg</b></span></p>
                    </td>
                </tr>
                <tr>    
                    <td class="tdprop tdnum"><p>14</p></td>
                    <td class="tdprop"><p><span style="margin-right:114px">Biaya Kirim Ke Lokasi (Rp)</span><span style="margin-right:20px">:</span><span style="margin-right:30px"><b><?= 'Rp '.number_format($model->biaya_kirim,0,",",".").' ,-'; ?></b></span></p>
                    </td>
                </tr>

                <tr>    
                    <td class="tdprop tdnum"><p>15</p></td>
                    <td class="tdprop"><p><span style="margin-right:113px">Tanggal Berakhir Proposal</span><span style="margin-right:20px">:</span><span style="margin-right:30px"><b><?= date('d-m-Y', strtotime($model->prop_kadaluarsa)); ?></b></span></p>
                    </td>
                </tr>
                <tr>    
                    <td class="tdprop2" colspan="2">    
                       <p style="font-weight:400;"><span style="float: left; width:160px">Dibuat Oleh,</span><span style="margin-left:180px; float: left; width:160px">Disetujui Oleh,</span><span style="margin-left:180px; float: left; width:160px">Disetujui Oleh,</span><span style="margin-left:180px; float: left; width:160px">Disetujui Oleh,</span></p>

                       <p style="font-weight:400; margin-top:70px"><span style="border-top:solid 1px #ddd; float: left; width:160px">Penebas</span><span style="border-top:solid 1px #ddd; margin-left:180px; float: left; width:160px">ABMI</span><span style="border-top:solid 1px #ddd; margin-left:180px; float: left; width:160px">PT. PPI (Persero)</span><span style="border-top:solid 1px #ddd; margin-left:180px; float: left; width:160px">PT. BGR (Persero)</span></p>
                       <p style="font-weight:400;"><span style="float: left; width:160px">Tgl : </span><span style="margin-left:180px; float: left; width:160px">Tgl : </span><span style="margin-left:180px; float: left; width:160px">Tgl : </span><span style="margin-left:180px; float: left; width:160px">Tgl :</span></p>

                    </td>
                </tr>    
            </table>
        
        </div>
    </div>

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
