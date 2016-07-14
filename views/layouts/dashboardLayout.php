<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\DashboardAsset;
use mdm\admin\components\MenuHelper;

DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="full" lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class'=>'container-fluid'],
        'brandOptions' => ['class' => 'navbar-brand'],
        'options' => [
            'class' => 'navbar navbar-amsys',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav'],
        'encodeLabels' => false,
        'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)
    ]);

    echo Nav::widget([
          'options' => ['class' => 'user-menu navbar-nav navbar-right'],
          'encodeLabels' => false,
          'items' => [
              Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
              ) : (

              [
                // 'label' => '<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>'.Yii::$app->user->identity->username.'', 'url' => ['#'],

              'label' => '<i class="fa fa-user"></i> '.Yii::$app->user->identity->username.'', 'url' => ['#'],
                'items' => [
                  ['label' => '<i class="fa fa-user"></i> Profile', 'url' => ['#']],
                  ['label' => '<i class="fa fa-gear"></i>  Settings', 'url' => ['#']],

                  '<li>'
                      . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                      . Html::submitButton('<i class="fa fa-power"></i> Logout', ['class' => 'btn btn-raised btn-danger'])
                      . Html::endform() .
                  '</li>',
                ],

              ]
              )
          ],
      ]);
    NavBar::end();
    ?>
    <div class="container">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; BGR <?= date('Y') ?></p>

        <p class="pull-right">Supported By: ABMI &amp; PPI</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
