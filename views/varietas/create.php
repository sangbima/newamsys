<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Varietas */

$this->title = 'Tambah Varietas';
$this->params['breadcrumbs'][] = ['label' => 'Varietas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="varietas-create">

    <?= $this->render('_form', [
        'model' => $model,    
    ]) ?>

</div>
