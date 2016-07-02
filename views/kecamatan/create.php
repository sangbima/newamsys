<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Kecamatan */

$this->title = 'Tambah Kecamatan';
$this->params['breadcrumbs'][] = ['label' => 'Kecamatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container kecamatan-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
