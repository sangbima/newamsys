<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JenisBobotKering */

$this->title = 'Tambah Jenis Bobot Kering';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Bobot Kering', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-bobot-kering-create">
    <?= $this->render('_form', [
        'model' => $model,

    ]) ?>
</div>
