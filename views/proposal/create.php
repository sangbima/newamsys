<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Proposal */

$this->title = 'Formulir Penebasan';
$this->params['breadcrumbs'][] = ['label' => 'Proposal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proposal-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
