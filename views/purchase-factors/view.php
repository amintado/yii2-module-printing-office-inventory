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

        </div>
        <div class="col-sm-3" style="margin-top: 15px">
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
        'serial',
        'date',
        'register_time',
        [
            'attribute' => 'u.username',
            'label' => 'Uid',
        ],
        [
            'attribute' => 'company0.name',
            'label' => 'Company',
        ],
        'sum',
        'status',
        [
            'attribute' => 'storage0.name',
            'label' => 'Storage',
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
        <h4>StoragePeoples<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnStoragePeoples = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'telephone',
        'address',
        'economic_code',
        'description',
    ];
    echo DetailView::widget([
        'model' => $model->company0,
        'attributes' => $gridColumnStoragePeoples    ]);
    ?>
    <div class="row">
        <h4>Storage<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnStorage = [
        'name',
    ];
    echo DetailView::widget([
        'model' => $model->storage0,
        'attributes' => $gridColumnStorage    ]);
    ?>
    <div class="row">
        <h4>Users<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnUsers = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'hash_id',
        'fullname',
        'RoleID',
        'Image',
        'auth_key',
        'access_token',
        'password_hash',
        'password_reset_token',
        'email',
        'status',
        'IsPrivate',
        'LastLoginIP',
        'imei',
        'UUID',
        ['attribute' => 'lock', 'visible' => false],
        'mode',
        'VerificationCode',
    ];
    echo DetailView::widget([
        'model' => $model->u,
        'attributes' => $gridColumnUsers    ]);
    ?>
    
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-taban-storage-factor-items']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Storage Factor Items'),
        ],
        'columns' => $gridColumnStorageFactorItems
    ]);
}
?>

    </div>
</div>
