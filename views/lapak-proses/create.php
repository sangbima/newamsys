<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LapakProses */

$this->title = 'Create Lapak Proses';
$this->params['breadcrumbs'][] = ['label' => 'Lapak Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lapak-proses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
