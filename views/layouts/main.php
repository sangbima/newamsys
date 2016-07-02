<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AmsysAsset;
use mdm\admin\components\MenuHelper;

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
    // NavBar::begin([
    //     'brandLabel' => 'My Company',
    //     'brandUrl' => Yii::$app->homeUrl,
    //     'options' => [
    //         'class' => 'navbar-inverse navbar-fixed-top',
    //     ],
    // ]);
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav'],
        'encodeLabels' => false,
        'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)
    ]);
    // echo Nav::widget([
    //     'options' => ['class' => 'nav navbar-nav'],
    //     'encodeLabels' => false,
    //     'items' => [
    //         ['label' => 'Home', 'url' => ['/site/index']],
    //         // ['label' => 'About', 'url' => ['/site/about']],
    //         // ['label' => 'Contact', 'url' => ['/site/contact']],
    //         // [
    //         //     'label' => '<i class="fa fa-scissors" style="color:#66BAC1"></i> Tebasan', 'url' => ['#'],
    //         //     'template' => '<a href="{url}" class="href_class">{label}</a>',
    //         //     'items' => [
    //         //       ['label' => ' Produksi', 'url' => ['produksi/index']],
    //         //       ['label' => '<i class="fa fa-file-o" style="color:#fdf9b2"></i> Formulir Antar', 'url' => ['formulir/index']],
    //         //     ]
    //         // ],
    //
    //         [
    //             'label' => '<i class="fa fa-database" style="color:#FFF"></i> Master Data', 'url' => ['#'],
    //             'template' => '<a href="{url}" class="href_class">{label}</a>',
    //             'items' => [
    //               ['label' => 'Propinsi', 'url' => ['provinsi/index']],
    //               ['label' => 'Kabupaten Kota', 'url' => ['kabupatenkota/index']],
    //               ['label' => 'Kecamatan', 'url' => ['kecamatan/index']],
    //               ['label' => 'Desa / Kelurahan', 'url' => ['desakelurahan/index']],
    //               ['label' => 'Petani', 'url' => ['petani/index']],
    //               ['label' => 'Komoditas', 'url' => ['komoditas/index']],
    //               ['label' => 'Varietas', 'url' => ['varietas/index']],
    //               ['label' => 'Jenis Bobot Kering', 'url' => ['jenis-bobot-kering/index']],
    //               ['label' => 'Tag Pasar', 'url' => ['pasar-tag/index']],
    //               ['label' => 'Pasar', 'url' => ['pasar/index']],
    //
    //             ]
    //         ],
    //         [
    //             'label' => '<i class="fa fa-file-o" style="color:#FFF"></i> Laporan', 'url' => ['#'],
    //             'template' => '<a href="{url}" class="href_class">{label}</a>',
    //             'items' => [
    //               ['label' => 'Info Harga', 'url' => ['map/info-harga']],
    //               ['label' => 'Sebaran Petani', 'url' => ['map/petani-map']],
    //
    //             ]
    //         ],
    //         ['label' => '<i class="fa fa-file-o" style="color:#FFF"></i> Proposal', 'url' => ['proposal/index']],
    //         ['label' => '<i class="fa fa-users" style="color:#FFF"></i> Manajemen User', 'url' => ['user/index']],
    //     ],
    // ]);
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
    <div class="col-md12">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
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
