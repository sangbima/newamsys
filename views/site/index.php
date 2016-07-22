<?php

/* @var $this yii\web\View */

$this->title = 'AMSYS Dashboard';
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
?>
<div class="site-index">
   <div style="margin-top:-70px">
        <h3>Dashboard</h3>

 <div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">Grafik Pantauan Harga Bawang</div>
      <div class="panel-body">
        <div class="canvas-wrapper">
          <?php
              echo Highcharts::widget([
               'options' => [
                   'chart'=> [
                      'type'=> 'line'
                  ],
                  'credits'=>[
                  'enabled'=>false
                  ],
                  'title' => ['text' => 'Harga Bawang di 5 Pasar Tradisional Dalam 30 Hari Terakhir'],
                  'xAxis' => [
                     'categories' => $dataX
                  ],
                  'yAxis' => [
                     'title' => ['text' => 'Harga Dalam Rupiah']
                  ],

                   'series' => $modelNama
               ]
            ]);
          ?>
        </div>
      </div>
    </div>
  </div>
</div><!--/.row-->

<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">Grafik Jumlah Petani Provinsi Jawa Tengah</div>
      <div class="panel-body">
        <div class="canvas-wrapper">
          <?php
              echo Highcharts::widget([
               'options' => [
                   'chart'=> [
                      'type'=> 'column'
                  ],
                  'credits' =>[
                    'enabled' =>false
                    ],
                  'title' => ['text' => 'Grafik Jumlah Petani Pada Provinsi Jawa tengah'],
                  'xAxis' => [
                     'categories' => ['Data Petani']
                  ],
                  'yAxis' => [
                     'title' => ['text' => 'Jumlah Petani']
                  ],
                   'series' => $graphOk
               ]
            ]);
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">Grafik Jumlah Petani Kabupaten Brebes</div>
      <div class="panel-body">
        <div class="canvas-wrapper">
          <?php
              echo Highcharts::widget([
               'options' => [
                   'chart'=> [
                      'type'=> 'column'
                  ],
                  'credits' =>[
                    'enabled' =>false
                    ],
                  'title' => ['text' => 'Grafik Jumlah Petani Pada Kabupaten Brebes'],
                  'xAxis' => [
                     'categories' => ['Data Petani']
                  ],
                  'yAxis' => [
                     'title' => ['text' => 'Jumlah Petani']
                  ],
                   'series' => $graphOkKec
               ]
            ]);
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
   </div>
</div>
