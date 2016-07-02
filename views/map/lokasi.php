<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Lokasi;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LokasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Map Luas Lahan Petani Bawang per Kecamatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lokasi-index">
<div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                    <h3><i class="fa fa-map"></i> <?= Html::encode($this->title) ?></h3>

                    <div id="googleMap" style="width:100%;height:530px;"></div>

                </div>
            </div>
        </div>
    </div>

</div>

<?php 

$this->registerJs('
var myCenter=new google.maps.LatLng(-6.875641,109.684556);
function initialize() {
  var mapProp = {
    center:myCenter,
    zoom:8,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
  var coba = '.$model.';  
  
  coba.forEach(function(element,index){
      
      var pramarker = "marker"+element.id; 
      var hektar = element.luasLahan/1000;
      var pramarker=new google.maps.Marker({
      position:new google.maps.LatLng(element.latitude,element.longitude),
      });

      pramarker.setMap(map);
      
      var infowindow = new google.maps.InfoWindow({
      content:"<b> Kecamatan "+element.nama+"</b><br /> Luas Lahan : "+ hektar +" Hektar"

      });

    google.maps.event.addListener(pramarker, "click", function() {
      infowindow.open(map,pramarker);
      });

  });


}
google.maps.event.addDomListener(window, "load", initialize);');

?>