<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Peoples */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Peoples', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peoples-view">

    <div class="row">
        <div class="col-sm-8">

        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'یک فایل PDF از داده های انتخابی در پنجره ی جدید نمایش داده خواهد شد'
                ]
            )?>
            <?= Html::a('ایجاد یک کپی', ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a('بروزرسانی', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('حذف', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'این آیتم حذف خواهد شد،از این بابت اطمینان دارید؟',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'telephone',
        'address',
        'economic_code',
        'description:ntext',
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
                'attribute' => 'category0.name',
                'label' => 'Category'
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerStoragePeoplesCategoriesList,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-taban-storage-peoples-categories-list']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Storage Peoples Categories List'),
        ],
        'columns' => $gridColumnStoragePeoplesCategoriesList
    ]);
}
?>

    </div>
</div>
