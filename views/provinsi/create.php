<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Provinsi */

$this->title = 'Tambah Provinsi';
$this->params['breadcrumbs'][] = ['label' => 'Provinsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provinsi-create">
	<?= $this->render('_form', [
	    'model' => $model,
	]) ?>

</div>
