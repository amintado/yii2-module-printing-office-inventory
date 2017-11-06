<?php

use kartik\export\ExportMenu;
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

    <div class="row" style="margin-top: 15px">
        <div class="col-md-8"></div>
        <div class="col-sm-4" >
            <?=
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('atpinventory', 'PDF'),
                ['pdf', 'id' => $model->name],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('atpinventory', 'Will open the generated PDF file in a new window')
                ]
            ) ?>
            <?= Html::a(Yii::t('atpinventory', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('atpinventory', 'Delete'), ['delete', 'id' => $model->name], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('atpinventory', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
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

    </div>
    <div class="row">
        <div class="col-md-12">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' =>
                    [
                        'product',
                        [
                            'attribute'=>'stock',
                            'filter'=>false
                        ],
                    ],
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-storage']],
                'panel' => [
                    'type' => GridView::TYPE_INFO,
                    'heading' => false,
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
                    ]),
                ],
            ]) ?>
        </div>

    </div>
</div>
