<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ArmadaKirim */

$this->title = 'Tambah Armada';
$this->params['breadcrumbs'][] = ['label' => 'Armada Kirim', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armada-kirim-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
