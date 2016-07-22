<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'AMSYS Dashboard';

?>
<div class="content">
    <figure class="org-chart cf">
        <ul class="administration">
            <li>
                <ul class="director">
                    <li>
                        <a href="#"><span>AMSYS</span></a>
                        <ul class="departments cf">
                            <li></li>
                            <li id="first-dept" class="department dep-a">
                                <?= Html::a('<span>CANVASSING</span>', ['#']) ?>
                            </li>
                            <li class="department dep-b">
                                <?= Html::a('<span>TRADING</span>', ['/proposal/index']) ?>
                            </li>
                            <li class="department dep-c">
                                <?= Html::a('<span>DISTRIBUTION</span>', ['#']) ?>
                            </li>
                            <li id="last-dept" class="department dep-d">
                                <?= Html::a('<span>HILIR</span>', ['#']) ?>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </figure>
</div>
