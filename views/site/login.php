<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boxlogin">
<div class="site-login col-md-4 col-md-offset-4">
    <div class="well">

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'bs-component'],
            'fieldConfig' => [
                'options' => ['class' => 'form-group label-floating'],
                'template' => "{label}{input}<span class=\"material-input\"></span>",
            ]
        ]); ?>
        <!-- <h1 class="text-center"><i class="glyphicon glyphicon-dashboard"></i></h1> -->
        <h3 style="margin-bottom:70px; color:#fff">Login AMSYS</h3>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-11\"><div class=\"togglebutton\"><label>{input} Remember Me</label></div></div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <?= Html::submitButton('<i class="glyphicon glyphicon-log-in"></i> Login', ['class' => 'btn btn-raised btn-primary', 'name' => 'login-button']) ?>

        <?php ActiveForm::end(); ?>

    </div>
</div>
</div>
