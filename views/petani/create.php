<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Petani */

$this->title = 'Tambah Petani';
$this->params['breadcrumbs'][] = ['label' => 'Petani', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container petani-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
