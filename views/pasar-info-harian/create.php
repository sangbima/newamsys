<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PasarInfoHarian */

$this->title = 'Tambah Pasar Info Harian';
$this->params['breadcrumbs'][] = ['label' => 'Pasar Info Harian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasar-info-harian-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
