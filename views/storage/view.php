<?php
/*******************************************************************************
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 ******************************************************************************/

use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\StorageItems */

$this->title = 'نمایش اطلاعات انبار ' . $model[0]->storage;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Storage Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="storage-items-view">
    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
//        [
//            'attribute' => 'storage',
//            'label' => Yii::t('common', 'Storage'),
//            'value' => function($model){
//                if ($model->storage0)
//                {return $model->storage0->name;}
//                else
//                {return NULL;}
//            },
//            'filterType' => GridView::FILTER_SELECT2,
//            'filter' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Storage::find()->asArray()->all(), 'name', 'name'),
//            'filterWidgetOptions' => [
//                'pluginOptions' => ['allowClear' => true],
//            ],
//            'filterInputOptions' => ['placeholder' => 'Taban storage', 'id' => 'grid-storage-items-search-storage']
//        ],
        'product',
        [
            'attribute' => 'stock',
            'class' => 'kartik\grid\EditableColumn',
            'editableOptions' => [
                'header'=>'موجودی اولیه ی کالا در این انبار را تنظیم کنید',
                'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                'options'=>['pluginOptions'=>['min'=>0, 'max'=>5000]],
                'formOptions' => ['action' => ['stock']]
            ],
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 0],
            'pageSummary'=>true,
            'filter' => false
        ],
        [
          'attribute'=>'max_indicator',
            'class' => 'kartik\grid\EditableColumn',
            'editableOptions' => [
                'header'=>'حداکثر موجودی را تنظیم کنید',
                'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                'options'=>['pluginOptions'=>['min'=>0, 'max'=>5000]],
                'formOptions' => ['action' => ['max-indicator']]
            ],
            'format'=>['decimal', 0],
        ],
        [
          'attribute'=>'min_indicator',
            'class' => 'kartik\grid\EditableColumn',
            'editableOptions' => [
                'header'=>'حداقل موجودی را تنظیم کنید',
                'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                'options'=>['pluginOptions'=>['min'=>0, 'max'=>5000]],
                'formOptions' => ['action' => ['min-indicator']]
            ],
            'format'=>['decimal', 0],
        ],
    ];
    ?>
    <div class="row">
        <div class="col-sm-8">
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
            <?=
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('common', 'PDF'),
                ['pdf', 'id' => $model[0]->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('common', 'Will open the generated PDF file in a new window')
                ]
            ) ?>
            <?= Html::a(Yii::t('common', 'بروزرسانی'), ['update', 'id' => urlencode($model[0]->storage)], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">کالاها و موجودی انبار</h3>
                </div>
                <div class="panel-body">
                    <div class="row">

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => $gridColumn,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-storage-items']],
                            'panel' => [
                                'type' => GridView::TYPE_DEFAULT,
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
                                        'label' => 'خروجی از همه ی اطلاعات',
                                        'class' => 'btn btn-default',
                                        'itemsBefore' => [
                                            '<li class="dropdown-header">خروجی از همه ی اطلاعات</li>',
                                        ],
                                    ],
                                ]),
                            ],
                        ]); ?>

                    </div>


                </div>
            </div>
        </div>

    </div>

</div>
