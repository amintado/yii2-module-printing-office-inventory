<?php

/* @var $this yii\web\View */
/* @var $searchModel amintado\pinventory\models\StorageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('atpinventory', 'Storages');
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

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('atpinventory', 'Create Storage'), ['#'], ['class' => 'btn btn-success','id'=>'createbtn']) ?>
    </p>

    <?php 
    $gridColumn = [
        'name',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => 'تغییر اسم انبار']);
                },
            ],

        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => ' {items}',
            'buttons' => [
                'items' => function ($url, $model) {
                    $moduleID=Yii::$app->controller->module->id;
                    $storage=urlencode($model->name);
                    return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', ["/$moduleID/storage-items/view?id=".$storage], ['title' => 'اقلام انبار']);
                },
            ],

        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => ' {changeitems}',
            'buttons' => [
                'changeitems' => function ($url, $model) {
                    $moduleID=Yii::$app->controller->module->id;
                    $storage=urlencode($model->name);
                    return Html::a('<span class="glyphicon glyphicon-transfer"></span>', ["/$moduleID/storage/update?id=".$storage], ['title' => 'تغییر اقلام داخل انبار']);
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
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-storage']],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => false,
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => false
    ]); ?>

</div>
