<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\PeoplesCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Peoples Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peoples-category-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Peoples Category'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
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
if($providerStoragePeoplesCategoriesList->totalCount){
    $gridColumnStoragePeoplesCategoriesList = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'people0.name',
                'label' => 'People'
            ],
            ];
    echo Gridview::widget([
        'dataProvider' => $providerStoragePeoplesCategoriesList,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Storage Peoples Categories List'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnStoragePeoplesCategoriesList
    ]);
}
?>
    </div>
</div>
