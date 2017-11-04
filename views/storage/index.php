<?php

/* @var $this yii\web\View */
/* @var $searchModel amintado\pinventory\models\StorageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\web\View;

$this->title = Yii::t('common', 'Storages');
$this->params['breadcrumbs'][] = $this->title;


$j=<<<JS
$('#createbtn').click(function(e){
    e.preventDefault();
    $('#Createmodal').modal('show');
});
JS;
$this->registerJs($j,View::POS_END);




Modal::begin([
        'id'=>'Createmodal'
]);
echo $this->render('create',['model'=> $model]);
Modal::end();
?>





<div class="storage-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('common', 'Create Storage'), ['#'], ['class' => 'btn btn-success','id'=>'createbtn']) ?>
    </p>

    <?php 
    $gridColumn = [
        'name',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',

        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-storage']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
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
