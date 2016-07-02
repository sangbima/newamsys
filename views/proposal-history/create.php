<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProposalHistory */

$this->title = 'Create Proposal History';
$this->params['breadcrumbs'][] = ['label' => 'Proposal Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proposal-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
