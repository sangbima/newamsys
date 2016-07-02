<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PasarPermintaan */

$this->title = 'Tambah Pasar Permintaan';
$this->params['breadcrumbs'][] = ['label' => 'Pasar Permintaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasar-permintaan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
