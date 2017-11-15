<?php

/* @var $this yii\web\View */
/* @var $searchModel amintado\pinventory\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = Yii::t('atpinventory', 'Products');
$this->params['breadcrumbs'][] = $this->title;

$j=<<<JS
$('#createbtn').click(function(e) {
    e.preventDefault();
    $('#CreateModal').modal('show');
  
});
JS;
$this->registerJs($j);

Modal::begin(['id'=>'CreateModal','header' => '<h3>ثبت کالای جدید</h3>']);
echo $this->render('create',['model'=> $model]);
Modal::end();
?>
<div class="product-index">


    <p>
        <?= Html::a(Yii::t('atpinventory', 'Create Product'), ['create'], ['class' => 'btn btn-success','id'=>'createbtn']) ?>
    </p>

    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'descrition:ntext',
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
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-product']],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => false
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
                    'label' => Yii::t('atpinventory', 'Export All'),
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">'. Yii::t('atpinventory', 'Export All').'</li>',
                    ],
                ],
            ]) ,
        ],
    ]); ?>

</div>
