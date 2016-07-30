<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'AMSYS Dashboard';

?>
<div class="frame"> 
    <div class="inframe">
        <div class="logo">
            <!-- <img src="images/logobgr.png" alt=""> -->
            <?= Html::img('@web/images/logobgr.png'); ?>
        </div>

        <div class="logotext">
            <h3>AMSYS</h3>
            <p>Agriculture Management System</p>
        </div>

        <div class="red">
            <div class="textbox">
                <!-- <a href="#" class="canvasing"></a><p class="texticon"><i class="jarakicon fa fa-gear"></i><span class="spantext">Canvasing</span></p></a> -->
                <?= Html::a('<p class="texticon"><i class="jarakicon fa fa-gear"></i><span class="spantext">Canvasing</span></p>', ['#'], ["class"=>"canvasing"]) ?>
            </div>
            
        </div>

        <div class="orange">
            <div class="textbox">
                <!-- <a href="#" class="canvasing"></a><p class="texticon"><i class="jarakicon fa fa-gear"></i><span class="spantext">Canvasing</span></p></a> -->
                <?= Html::a('<p class="texticon"><i class="jarakicon fa fa-send"></i><span class="spantext">Trading</span></p>', ['/proposal/index'], ["class"=>"canvasing"]) ?>
            </div>
        </div>

        <div class="green">
            <div class="textbox">
                <!-- <a href="#" class="canvasing"></a><p class="texticon"><i class="jarakicon fa fa-gear"></i><span class="spantext">Canvasing</span></p></a> -->
                <?= Html::a('<p class="texticon"><i class="jarakicon fa fa-truck"></i><span class="spantext">Distribution</span></p>', ['#'], ["class"=>"canvasing"]) ?>
            </div>
        </div>

        <div class="blue">
            <div class="textbox2">
                <!-- <a href="#" class="canvasing"></a><p class="texticon"><i class="jarakicon fa fa-gear"></i><span class="spantext">Canvasing</span></p></a> -->
                <?= Html::a('<p class="texticon"><i class="jarakicon fa fa-cubes"></i><span class="spantext">Hilir</span></p>', ['#'], ["class"=>"canvasing"]) ?>
            </div>
        </div>

        <div class="grey">
            <div class="textbox3">
                <!-- <a href="#" class="canvasing"></a><p class="texticon"><i class="jarakicon fa fa-gear"></i><span class="spantext">Canvasing</span></p></a> -->
                <?= Html::a('<p class="texticon"><i class="jarakicon fa fa-user-secret"></i><span class="spantext">About</span></p>', ['#'], ["class"=>"canvasing"]) ?>
            </div>
        </div>

        
    </div>
</div>
<?php
$this->registerJs('
        $(".canvasing").hover(function(){
            $( ".canvasing2" ).switchClass( "canvasing2", "canvasing", 1000 );
        })');
?>