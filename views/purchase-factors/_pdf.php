<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Factor */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Factors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factor-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Factor'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'serial',
        'date',
        'register_time',
        [
                'attribute' => 'u.username',
                'label' => 'Uid'
            ],
        [
                'attribute' => 'company0.name',
                'label' => 'Company'
            ],
        'sum',
        'status',
        [
                'attribute' => 'storage0.name',
                'label' => 'Storage'
            ],
        'tax',
        'discount',
        'transportation',
        'description',
        'paymentPrice',
        'module',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerStorageFactorItems->totalCount){
    $gridColumnStorageFactorItems = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'product0.name',
                'label' => 'Product'
            ],
        'price',
        'tax',
        'discount',
        'total',
            ];
    echo Gridview::widget([
        'dataProvider' => $providerStorageFactorItems,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Storage Factor Items'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnStorageFactorItems
    ]);
}
?>
    </div>
</div>
