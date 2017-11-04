<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Storage */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Storages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="storage-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('common', 'Storage').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'name',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerStorageItems->totalCount){
    $gridColumnStorageItems = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'zink_no',
        'circulation',
        'frame_count',
        'zink_count',
        'dimentions',
        'one_and_two',
        'color_count',
        'color_5',
        'inventory',
        'sex',
        'date',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerStorageItems,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('common', 'Storage Items')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnStorageItems
    ]);
}
?>
    </div>
</div>
