<?php

/* @var $this yii\web\View */
/* @var $searchModel amintado\pinventory\models\SalesFactorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Factors';
$this->params['breadcrumbs'][] = $this->title;
$j=<<<JS

$('#createbtn').click(function(e) {
e.preventDefault();
$('#CreateModal').modal('show');
});
$('#cancel').click(function(e) {
e.preventDefault();
$('#CreateModal').modal('hide');
});
JS;
$this->registerJs($j);
Modal::begin(['id' => 'CreateModal']);
echo $this->render('create',['model'=> $model]);
Modal::end();
?>
<div class="factor-index">

    <p>
        <?= Html::a('Create Factor', ['#'], ['class' => 'btn btn-success','id'=>'createbtn']) ?>

    </p>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'serial',
        'date',
        'register_time',
        [
                'attribute' => 'uid',
                'label' => 'Uid',
                'value' => function($model){
                    if ($model->u)
                    {return $model->u->username;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Users::find()->asArray()->all(), 'id', 'username'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Taban users', 'id' => 'grid-sales-factor-search-uid']
            ],
        [
                'attribute' => 'company',
                'label' => 'Company',
                'value' => function($model){
                    if ($model->company0)
                    {return $model->company0->name;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\StoragePeoples::find()->asArray()->all(), 'name', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Taban storage peoples', 'id' => 'grid-sales-factor-search-company']
            ],
        'sum',
        'status',
        [
                'attribute' => 'storage',
                'label' => 'Storage',
                'value' => function($model){
                    if ($model->storage0)
                    {return $model->storage0->name;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Storage::find()->asArray()->all(), 'name', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Taban storage', 'id' => 'grid-sales-factor-search-storage']
            ],
        'tax',
        'discount',
        'transportation',
        'description',
        'paymentPrice',
        'module',
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
