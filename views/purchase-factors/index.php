<?php

/* @var $this yii\web\View */
/* @var $searchModel amintado\pinventory\models\PurchaseFactorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Factors';
$this->params['breadcrumbs'][] = $this->title;
$j=<<<JS

$('#createbtn').click(function(e) {
//e.preventDefault();
$('#CreateModal').modal('show');
});
$('#cancel').click(function(e) {
e.preventDefault();
$('#CreateModal').modal('hide');
});
JS;
$this->registerJs($j);

?>

<div id="CreateModal" class="fade modal in" role="dialog" style="padding-right: 17px;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4>ثبت فاکتور خرید</h4>
            </div>
            <div class="modal-body">
                <?php // $this->render('create',['model'=> $model]);
                ?>
            </div>
        </div>
    </div>
</div>




<div class="factor-index">

    <p>
        <?= Html::a('Create Factor', ['create'], ['class' => 'btn btn-success','id'=>'createbtn']) ?>

    </p>
    <?php 
    $gridColumn = [

        ['attribute' => 'id', 'visible' => false],
        'serial',
        'date',


        'sum',
        'status',
//        [
//                'attribute' => 'storage',
//                'label' => 'Storage',
//                'value' => function($model){
//                    if ($model->storage0)
//                    {return $model->storage0->name;}
//                    else
//                    {return NULL;}
//                },
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Storage::find()->asArray()->all(), 'name', 'name'),
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                ],
//                'filterInputOptions' => ['placeholder' => 'Taban storage', 'id' => 'grid-purchase-factor-search-storage']
//            ],

        'description',
        'paymentPrice',

        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-factor']],
        'panel' => [
            'type' => GridView::TYPE_ACTIVE,
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
                    'label' => 'استخراح همه ی اطلاعات',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">استخراج همه ی اطلاعات</li>',
                    ],
                ],
            ]) ,
        ],
    ]); ?>

</div>
