<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> User', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
    </p>
    <?php } ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'created_at',
            // 'updated_at',
            // 'user_id',
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'fullname',
            'email:email',
            // [
			// 	'attribute' => 'roles',
			// 	'format' => 'raw',
			// 	'value' => function ($data) {
			// 		$roles = [];
			// 		foreach ($data->roles as $role) {
			// 			$roles[] = $role->item_name;
			// 		}
			// 		return Html::a(implode(', ', $roles), ['view', 'id' => $data->id]);
			// 	}
			// ],
            [
                'attribute'=>'status',
                'format'=>'raw',
                'value'=>function($d){
                    return $d->status == 10 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Banned</span>';
                }
            ],
            // 'tanda_setuju',
            // 'tanda_tolak',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
