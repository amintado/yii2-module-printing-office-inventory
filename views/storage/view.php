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
        <div class="col-sm-8">
            <h2><?= Yii::t('common', 'Storage').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('common', 'PDF'), 
                ['pdf', 'id' => $model->name],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('common', 'Will open the generated PDF file in a new window')
                ]
            )?>
            <?= Html::a(Yii::t('common', 'Save As New'), ['save-as-new', 'id' => $model->name], ['class' => 'btn btn-info']) ?>            
            <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->name], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-taban-storage-items']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('common', 'Storage Items')),
        ],
        'columns' => $gridColumnStorageItems
    ]);
}
?>

    </div>
</div>
