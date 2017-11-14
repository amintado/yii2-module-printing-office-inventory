<?php

/* @var $this yii\web\View */
/* @var $searchModel amintado\pinventory\models\PrintSearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use amintado\pinventory\models\Sprint;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\web\View;

$this->title = Yii::t('atpinventory', 'Sprints');
$this->params['breadcrumbs'][] = $this->title;
$j = <<<JS
$('#createbtn').click(function(e) {
     e.preventDefault();
  $('#CreateModal').modal('show');
  setTimeout(function() {
    $('#sprint-storage').select2('open');
  
    $('#w1').datepicker('show');
    
  },1000);
    setTimeout(function() {
        $('.datepicker-dropdown').attr({right:'auto !important',left:'auto !important'});
    },1500);

});
JS;
$this->registerJs($j, View::POS_END);





?>







<div class="modal fade" id="CreateModal"  role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ثبت چاپ</h4>
            </div>
            <div class="modal-body">
                <?php echo $this->render('create', ['model' => $model]);  ?>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="sprint-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('atpinventory', 'Create Sprint'), ['#'], ['class' => 'btn btn-success', 'id' => 'createbtn']) ?>
    </p>

    <?php
    $gridColumn = [
        [
            'class' => '\kartik\grid\CheckboxColumn'
        ],
        [
            'attribute' => 'storage',
            'value' => function ($model) {
                if (!empty($model->factor_num)) {
                    /**
                     * @var $this View
                     */
                    $this->registerCss('tr[data-key="' . $model->id . '"]{
	background: hsla(115.5, 100%, 50%, 0.2) !important;}');

                }
                return $model->storage;
            },
            'format'=>'html',

        ],
        'product',
        'zink_number',
        'tiraj',
        'Dimensions',
        'page_count',
        [
                'attribute'=>'date',
            'value'=>function($model){
                return (new amintado\base\AmintadoFunctions())->convertdate($model->date);
            }
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => ' {view} {update} {delete} {factor}',
            'buttons' => [
                'save-as-new' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-copy"></span>', $url, ['title' => 'Save As New']);
                },
                'factor' => function ($url, $model) {

                    if (empty($model->factor_num)) {
                        $moduleID = Yii::$app->controller->module->id;
                        return Html::a('<span class="glyphicon glyphicon-ok"></span>', ["/$moduleID/print-factor/update?id=" . $model->id], ['title' => 'تایید فاکتور']);
                    } else {
                        return '';
                    }

                }
            ],
        ],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'floatHeader'=>true,
        'floatHeaderOptions'=>['scrollingTop'=>'50'],
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-sprint']],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}{toggleData}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'خروجی از همه ی اطلاعات',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">خروجی از همه ی اطلاعات</li>',
                    ],
                ],
                'panel' => [
                    'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Countries</h3>',
                    'type'=>'success',
                    'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
                    'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
                    'footer'=>false
                ],
            ]

                ),
        ],
    ]); ?>

</div>
