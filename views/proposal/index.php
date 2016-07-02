<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProposalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proposal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proposal-index">

    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Proposal', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
    </p>
    <?php } ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no_proposal',
            [
                'attribute'=>'komoditas_id',
                'label' => 'Komoditas',
                'value' => 'komoditas.nama',
            ],
            [
                'attribute'=>'petani_id',
                'label' => 'Petani',
                'value' => 'petani.nama'
            ],
            'est_bobot_basah',
            [
                'attribute' => 'tgl_panen',
                'headerOptions' => ['width' => '80'],
                'label' => 'Tgl Panen',
                'value' => function($d) {
                    return Yii::$app->formatter->format($d->tgl_panen, 'date');
                }
            ],
            [
                'label' => 'Total Biaya (Rp)',
                'value' => function($d) {
                    return Yii::$app->formatter->format($d->biaya_tebas + $d->biaya_proses, 'decimal');
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Persetujuan',
                // 'template' => Helper::filterActionColumn('{bgr}{abmi}{ppi}'),
                'template' => '{bgr}{abmi}{ppi}',
                'headerOptions' => ['width' => '140'],
                'buttons' => [
                    'bgr' => function($url, $model, $key){
                        $data = json_decode($model->setuju_status, true);
                        return Html::a($model->proposalstatusindex($data['BGR']), ['bgr-approval', 'id'=>$model->id], ['class' => 'btn btn-xs btn-raised '.$model->proposalstatuscolor($data['BGR']), 'data-toggle' => 'modal', 'data-target' => '#bgrModal', 'data-title' => 'Persetujuan BGR: <span class="label ' . $model->proposallabelcolor($data['BGR']).'">'.$model->proposalstatusindex($data['BGR']).'</span>', 'data-hover' => 'tooltip', 'data-placement' => 'top', 'data-original-title' => 'BGR ' . $data['BGR']]);
                    },
                    'abmi' => function($url, $model, $key){
                        $data = json_decode($model->setuju_status, true);
                        return Html::a($model->proposalstatusindex($data['ABMI']), ['abmi-approval', 'id'=>$model->id], ['class' => 'btn btn-xs btn-raised '.$model->proposalstatuscolor($data['ABMI']), 'data-toggle' => 'modal', 'data-target' => '#abmiModal', 'data-title' => 'Persetujuan ABMI: <span class="label ' . $model->proposallabelcolor($data['ABMI']).'">'.$model->proposalstatusindex($data['ABMI']).'</span>', 'data-hover' => 'tooltip', 'data-placement' => 'top', 'data-original-title' => 'ABMI ' . $data['ABMI']]);
                    },
                    'ppi' => function($url, $model, $key){
                        $data = json_decode($model->setuju_status, true);
                        return Html::a($model->proposalstatusindex($data['PPI']), ['ppi-approval', 'id'=>$model->id], ['class' => 'btn btn-xs btn-raised '.$model->proposalstatuscolor($data['PPI']), 'data-toggle' => 'modal', 'data-target' => '#ppiModal', 'data-title' => 'Persetujuan PPI: <span class="label ' . $model->proposallabelcolor($data['PPI']).'">'.$model->proposalstatusindex($data['PPI']).'</span>', 'data-hover' => 'tooltip', 'data-placement' => 'top', 'data-original-title' => 'PPI ' . $data['PPI']]);
                    }
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{my_button} {view} {update} {delete}'),
                // 'headerOptions' => ['width' => '80'],
                'buttons' => [
                'my_button' => function ($url, $model, $key) {
                    return Html::a('<span class="fa fa-print"></span>', ['pdf', 'id'=>$model->id], ['target'=>'_blank']);
                },
            ]],
            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php

Modal::begin([
    'id' => 'bgrModal',
    'header' => '<h4 class="modal-title">...</h4>',
    'footer' => '<span class="label label-default">P</span> Pending <span class="label label-success">V</span> Setuju <span class="label label-danger">X</span> Ditolak',
    'size' => 'modal-lg'
]);

echo '...';

Modal::end();

Modal::begin([
    'id' => 'abmiModal',
    'header' => '<h4 class="modal-title">...</h4>',
    'footer' => '<span class="label label-default">P</span> Pending <span class="label label-success">V</span> Setuju <span class="label label-danger">X</span> Ditolak',
    'size' => 'modal-lg'
]);

echo '...';

Modal::end();

Modal::begin([
    'id' => 'ppiModal',
    'header' => '<h4 class="modal-title">...</h4>',
    'footer' => '<span class="label label-default">P</span> Pending <span class="label label-success">V</span> Setuju <span class="label label-danger">X</span> Ditolak',
    'size' => 'modal-lg'
]);

echo '...';

Modal::end();

$this->registerJs("
$(function () {
  $('[data-hover=\"tooltip\"]').tooltip();
})
");

$script = <<< JS
$('#bgrModal').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget)
    var modal = $(this)
    var title = button.data('title')
    var href = button.attr('href')
    modal.find('.modal-title').html(title)
    modal.find('.modal-body').html('<i class="fa fa-spiner fa-spin"></i>')
    $.post(href).done(function(data){
        modal.find('.modal-body').html(data)
    });
});
$('#abmiModal').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget)
    var modal = $(this)
    var title = button.data('title')
    var href = button.attr('href')
    modal.find('.modal-title').html(title)
    modal.find('.modal-body').html('<i class="fa fa-spiner fa-spin"></i>')
    $.post(href).done(function(data){
        modal.find('.modal-body').html(data)
    });
})
$('#ppiModal').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget)
    var modal = $(this)
    var title = button.data('title')
    var href = button.attr('href')
    modal.find('.modal-title').html(title)
    modal.find('.modal-body').html('<i class="fa fa-spiner fa-spin"></i>')
    $.post(href).done(function(data){
        modal.find('.modal-body').html(data)
    });
})
JS;

$this->registerJs($script);
?>
