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
                <?= Html::a('<p class="texticon"><i class="jarakicon fa fa-gear"></i><span class="spantext">Canvasing</span></p>', ['#'], ["class"=>"canvasing","title"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae saepe explicabo et officia deserunt, quasi provident delectus. Mollitia quibusdam dolore ipsum illo repellat praesentium nostrum, beatae sint incidunt, magni perferendis."]) ?>
            </div>
            
        </div>

        <div class="orange">
            <div class="textbox">
                <!-- <a href="#" class="canvasing"></a><p class="texticon"><i class="jarakicon fa fa-gear"></i><span class="spantext">Canvasing</span></p></a> -->
                <?= Html::a('<p class="texticon"><i class="jarakicon fa fa-send"></i><span class="spantext">Trading</span></p>', ['proposal/index'], ["class"=>"trading", "title"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae saepe explicabo et officia deserunt, quasi provident delectus. Mollitia quibusdam dolore ipsum illo repellat praesentium nostrum, beatae sint incidunt, magni perferendis."]) ?>
            </div>
        </div>

        <div class="green">
            <div class="textbox">
                <!-- <a href="#" class="canvasing"></a><p class="texticon"><i class="jarakicon fa fa-gear"></i><span class="spantext">Canvasing</span></p></a> -->
                <?= Html::a('<p class="texticon"><i class="jarakicon fa fa-truck"></i><span class="spantext">Distribution</span></p>', ['#'], ["class"=>"distri", "title"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae saepe explicabo et officia deserunt, quasi provident delectus. Mollitia quibusdam dolore ipsum illo repellat praesentium nostrum, beatae sint incidunt, magni perferendis."]) ?>
            </div>
        </div>

        <div class="blue">
            <div class="textbox2">
                <!-- <a href="#" class="canvasing"></a><p class="texticon"><i class="jarakicon fa fa-gear"></i><span class="spantext">Canvasing</span></p></a> -->
                <?= Html::a('<p class="texticon"><i class="jarakicon fa fa-cubes"></i><span class="spantext">Hilir</span></p>', ['#'], ["class"=>"hilir", "title"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae saepe explicabo et officia deserunt, quasi provident delectus. Mollitia quibusdam dolore ipsum illo repellat praesentium nostrum, beatae sint incidunt, magni perferendis."]) ?>
            </div>
        </div>

        <div class="grey">
            <div class="textbox3">
                <!-- <a href="#" class="canvasing"></a><p class="texticon"><i class="jarakicon fa fa-gear"></i><span class="spantext">Canvasing</span></p></a> -->
                <?= Html::a('<p class="texticon"><i class="jarakicon fa fa-user-secret"></i><span class="spantext">About</span></p>', ['#'], ["class"=>"about", "title"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae saepe explicabo et officia deserunt, quasi provident delectus. Mollitia quibusdam dolore ipsum illo repellat praesentium nostrum, beatae sint incidunt, magni perferendis."]) ?>
            </div>
        </div>


        <div class="sponsorlogo">
            <p>powered by </p>
            <?= Html::img('@web/images/pinbgr.png'); ?>
            <span style="margin-left:30px"></span>
            <?= Html::img('@web/images/pinabmi.png'); ?>
            <span style="margin-left:30px"></span>
            <?= Html::img('@web/images/pinppi.png'); ?>
        </div>

        
    </div>
</div>
<?php
$this->registerJs('$(document).ready(function() {
            $(".canvasing").tooltipster({
                theme: ["tooltipster-noir", "tooltipster-noir-canvasing"],
                side: "left",
                animation: "grow",
                maxWidth: 350,
                distance: 25,
                arrow:0,
            });
            
        });

        $(document).ready(function() {
            $(".trading").tooltipster({
                theme: ["tooltipster-noir", "tooltipster-noir-trading"],
                side: "left",
                animation: "grow",
                maxWidth: 350,
                distance: 30,
                arrow:0,
            });
            
        });
        $(document).ready(function() {
            $(".distri").tooltipster({
                theme: ["tooltipster-noir", "tooltipster-noir-distri"],
                side: "left",
                animation: "grow",
                maxWidth: 350,
                distance: 35,
                arrow:0,
            });
            
        });
        $(document).ready(function() {
            $(".hilir").tooltipster({
                theme: ["tooltipster-noir", "tooltipster-noir-hilir"],
                side: "left",
                animation: "grow",
                maxWidth: 350,
                distance: 35,
                arrow:0,
            });
            
        });

        $(document).ready(function() {
            $(".about").tooltipster({
                theme: ["tooltipster-noir", "tooltipster-noir-about"],
                side: "left",
                animation: "grow",
                maxWidth: 350,
                distance: 35,
                arrow:0,
            });
            
        });
        '
    );
?>