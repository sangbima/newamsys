<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      // 'bootstrap-material-design/css/roboto.css',
      // 'bootstrap-material-design/css/material-icons.css',
      // 'bootstrap-material-design/css/bootstrap-material-design.min.css',
      // 'bootstrap-material-design/css/ripples.min.css',
      'bootstrap-material-design/css/font-awesome.min.css',
      // 'css/site.css',
      // 'css/dashboard.css',
      'css/style.css',
      'css/tooltipster.bundle.min.css',
      'css/tooltipmodif.css',
    ];
    public $js = [
      // 'bootstrap-material-design/js/ripples.min.js',
      // 'bootstrap-material-design/js/material.min.js',
      // 'js/bootbox.min.js',
      // 'js/script.js',
    'js/tooltipster.bundle.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
