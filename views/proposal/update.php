<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proposal */

$this->title = 'Ubah Proposal: ' . $model->no_proposal;
$this->params['breadcrumbs'][] = ['label' => 'Proposals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_proposal, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="proposal-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
