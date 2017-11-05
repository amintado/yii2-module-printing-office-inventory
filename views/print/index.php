<?php

/* @var $this yii\web\View */
/* @var $searchModel amintado\pinventory\models\PrintSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\web\View;

$this->title = Yii::t('atpinventory', 'Sprints');
$this->params['breadcrumbs'][] = $this->title;
$j=<<<JS
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
$this->registerJs($j,View::POS_END);


Modal::begin(['id'=>'CreateModal',]);
echo $this->render('create',['model'=> $model]);
Modal::end();



?>
<div class="sprint-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('atpinventory', 'Create Sprint'), ['#'], ['class' => 'btn btn-success','id'=>'createbtn']) ?>
    </p>

    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'storage',
        'product',
        'zink_number',
        'tiraj',
        'frame_count',
        'zink_count',
        'Dimensions',
        'one_two',
        'color_count',
        'five_color',
        'page_count',
        'date',
        'uid',
        'description:ntext',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{save-as-new} {view} {update} {delete}',
            'buttons' => [
                'save-as-new' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-copy"></span>', $url, ['title' => 'Save As New']);
                },
            ],
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-sprint']],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
            ]) ,
        ],
    ]); ?>

</div>
