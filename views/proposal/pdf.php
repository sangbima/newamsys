<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

?>


<html>
<head>
    <meta charset="UTF-8"/>
</head>
<body>

	    <table style="border:none; font-size:12px" cellspacing="0" width="100%"> 
                <tr >
                    <td style="border:solid 1px #ddd" class="text-center" colspan="3"><h3 style="font-weight:400">Formulir Tebasan</h3></td>
                </tr>
                <tr>
                    <td class="text-center" style="border:none;border-left:solid 1px #ddd; border-bottom:solid 1px #ddd; padding:10px">
                        <?= Html::img('@web/images/abmi.png'); ?>
                    </td>
                    <td class="text-center" style="border:none; border-bottom:solid 1px #ddd">
                            <?= Html::img('@web/images/ppi.png'); ?>
                   
                   	</td>	
                    <td class="text-center" style="border:none;border-right:solid 1px #ddd; border-bottom:solid 1px #ddd; padding:10px">
                            <?= Html::img('@web/images/bgrlogo.png'); ?>
                    
                    </td>
                </tr>
			

                <tr>    
                    <td class="text-center" style="border:solid 1px #ddd; border-top:none; padding:10px" class="tdprop" colspan="3">    
                       <p style="font-weight:400">Rincian Formulir</p>
                    </td>
                </tr>
        </table>
        <table style="border:none; font-size:12px" cellspacing="0" width="100%">         
                <tr>
                    <td style="text-align:center; border:solid 1px #ddd; border-top:none; padding:8px 10px; width:10px"><p style="font-weight:500">No</p></td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px; text-align:center" colspan="3"><p style="font-weight:500">Data Formulir</p></td>
                </tr>
                <tr>
                    <td style="text-align:center; border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px"><p style="font-weight:500">1</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:140px"><p style="font-weight:500">No Formulir</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;"><?= $model->no_proposal; ?></td>
                </tr>

                <tr>
                    <td style="text-align:center; border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px"><p style="font-weight:500">2</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:110px"><p style="font-weight:500">Tanggal Survey</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;"><?= date('d-m-Y', strtotime($model->created_at)); ?></td>
                </tr>


                <tr>
                    <td style="text-align:center; border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px"><p style="font-weight:500">3</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:110px"><p style="font-weight:500">Nama Petani</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;"><?= $model->petani->nama; ?></td>
                </tr>

                <tr>
                    <td style="text-align:center; border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px"><p style="font-weight:500">4</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:110px"><p style="font-weight:500">Lokasi</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;">Desa/Kelurahan : <b><?= $model->desakelurahan->nama; ?>,</b> Kecamatan : <b><?= $model->kecamatan->nama; ?>, </b>Kota/Kabupaten : <b><?= $model->kabupatenkota->nama; ?></b></td>
                </tr>

                <tr>
                    <td style="text-align:center; border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px"><p style="font-weight:500">5</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:110px"><p style="font-weight:500">Luas Lahan</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;"><?= $model->luas_lahan.' '.$model->luas_unit; ?></b></td>
                </tr>
                <tr>
                    <td style="text-align:center; border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px"><p style="font-weight:500">6</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:110px"><p style="font-weight:500">Komoditas</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;"><b><?= $model->komoditas->nama; ?>,</b> </b>Varietas : <b><?= $model->varietas->nama; ?></b>, Jenis : <b><?= $model->jenis->nama; ?></b></b></td>
                </tr>

                <tr>
                    <td style="text-align:center; border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px"><p style="font-weight:500">7</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:110px"><p style="font-weight:500">Tgl Panen</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;"><b><?= date('d-m-Y', strtotime($model->tgl_panen)); ?></b>, Tanggal Tanam : <b><?= date('d-m-Y', strtotime($model->tgl_tanam)); ?></b></td>
                </tr>

                <tr>
                    <td style="border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px; text-align:center"><p style="font-weight:500">8</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:110px"><p style="font-weight:500">Tempat/Lapak Proses</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;">Desa/Kelurahan : <b><?= $model->lapakDesakel->nama; ?></b>, Kecamatan : <b><?= $model->lapakKec->nama; ?></b>, Kota/Kabupaten : <b><?= $model->lapakKabkota->nama; ?></b></td>
                </tr>

                <tr>
                    <td style="border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px; text-align:center"><p style="font-weight:500">9</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:110px"><p style="font-weight:500">Estimasi Bobot Pasah</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;"><b><?= ($model->est_bobot_basah/1000).' Ton'; ?></b>, Estimasi Bobot Kering : <b><?= ($model->est_bobot_kering/1000).' Ton'; ?></b></td>
                </tr>
                <tr>
                    <td style="border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px; text-align:center"><p style="font-weight:500">10</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:110px"><p style="font-weight:500">Biaya Tebas</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;"><b><?= 'Rp '.number_format($model->biaya_tebas,0,",",".").' '; ?></b>, Biaya Proses : <b><?= 'Rp '.number_format($model->biaya_proses,0,",","."); ?></b></td>
                </tr>

                <tr>
                    <td style="border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px; text-align:center"><p style="font-weight:500">11</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:110px"><p style="font-weight:500">Tujuan Pasar</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;"><b><?= $model->pasarTag->nama; ?>, </b>Est. Tgl Kirim : <b><?= date('d-m-Y', strtotime($model->est_tgl_kirim)); ?></b></td>
                </tr>

                <tr>
                    <td style="border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px; text-align:center"><p style="font-weight:500">12</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:110px"><p style="font-weight:500">Refrensi Permintaan (QTY)</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;"><b><?= $model->kapasitas_pasar; ?> Ton/Minggu</b>, Refrensi Nama Pasar : <b><?= $model->pasar->nama; ?></b></td>
                </tr>

                <tr>
                    <td style="border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px; text-align:center"><p style="font-weight:500">13</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:110px"><p style="font-weight:500">Est. Harga Penjualan (Rp/Kg)</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;"><b><?= 'Rp '.number_format($model->est_harga_jual,0,",",".").' ,-'; ?> /Kg</b></td>
                </tr>

                <tr>
                    <td style="border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px; text-align:center"><p style="font-weight:500">14</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:110px"><p style="font-weight:500">Biaya Kirim Ke lokasi</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;"><b><?= 'Rp '.number_format($model->biaya_kirim,0,",",".").' ,-'; ?></b></td>
                </tr>

                <tr>
                    <td style="border:solid 1px #ddd; border-top:none; padding:8px 5px; width:10px; text-align:center"><p style="font-weight:500">15</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:110px"><p style="font-weight:500">Tgl Berakhir Proposal</p></td>
                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; border-right:none; padding:8px 10px; width:10px">:</td>
                    <td style="border:solid 1px #ddd; border-left:none; border-top:none; padding:8px 5px;"><b><?= date('d-m-Y', strtotime($model->prop_kadaluarsa)); ?></b></td>
                </tr>
                </table>
				<table style="border:none; font-size:12px" cellspacing="0" width="100%">     		
				<tr>    
                    <td style="border:solid 1px #ddd; border-bottom: none; border-top:none; border-right: none; padding:8px 5px; width:10px; text-align:center">    
                       Dibuat Oleh,
                    </td>

                    <td style="border:solid 1px #ddd; border-bottom: none; border-top:none; border-left: none; border-right: none; padding:8px 5px; width:10px; text-align:center">    
                       Disetujui Oleh,

                    </td>

                    <td style="border:solid 1px #ddd; border-bottom: none; border-top:none; border-left: none; border-right: none; padding:8px 5px; width:10px; text-align:center">    
                       Disetujui Oleh,
                    </td>

                    <td style="border:solid 1px #ddd; border-bottom: none; border-top:none; border-left:none; padding:8px 5px; width:10px; text-align:center">    
                       Disetujui Oleh,
                    </td>


                </tr> 
				</table>
				<table style="border:none; font-size:12px" cellspacing="0" width="100%">     		
                <tr>    
                    <td style="border:solid 1px #ddd; border-bottom: none; border-top:none; border-right: none; padding:48px 5px 0px 40px; width:10px; ">    
                      Penebas
                    </td>

                    <td style="border:solid 1px #ddd; border-bottom: none; border-top:none; border-left: none; border-right: none; padding:48px 5px 0px 10px;">    
                       ABMI

                    </td>

                    <td style="border:solid 1px #ddd; border-bottom: none; border-top:none; border-left: none; border-right: none; padding:48px 5px 0px 0px; text-align:center">    
                       PT. PPI (Persero)
                    </td>

                    <td style="border:solid 1px #ddd; border-bottom: none; border-top:none; border-left:none; padding:48px 5px 0px 0px; width:10px; text-align:center">    
                       PT. BGR (Persero)
                    </td>


                </tr> 

                <tr>    
                    <td style="border:solid 1px #ddd; border-top:none; border-right: none; padding:1px 5px 10px 35px; width:10px;">    
                       Tgl :

                    </td>

                    <td style="border:solid 1px #ddd; border-top:none; border-left: none; border-right: none; padding:1px 5px 10px 5px; width:10px;">    
                       Tgl :
                       
                    </td>

                    <td style="border:solid 1px #ddd; border-top:none; border-left: none; border-right: none; padding:1px 5px 10px 55px; width:10px; ">    
                       Tgl :
                    </td>

                    <td style="border:solid 1px #ddd; border-top:none; border-left:none; padding:1px 5px 10px 25px; width:10px;">    
                       Tgl :
                    </td>


                </tr> 
                

                
            </table>
        
</body>
</html>

