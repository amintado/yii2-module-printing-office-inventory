<?php

/* @var $this yii\web\View */
/* @var $searchModel amintado\pinventory\models\CardexSearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use amintado\base\AmintadoFunctions;
use amintado\pinventory\models\Cardex;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'کاردکس کالا';
$this->params['breadcrumbs'][] = $this->title;
$j = <<<JS

$('#createbtn').click(function(e) {
e.preventDefault();
$('#CreateModal').modal('show');
});
$('#cancel').click(function(e) {
e.preventDefault();
$('#CreateModal').modal('hide');
});
JS;

?>
<div class="cardex-index">

    <?php
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'storage',
            'label' => 'انبار',
            'value' => function ($model) {
                if ($model->storage0) {
                    return $model->storage0->name;
                } else {
                    return NULL;
                }
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Storage::find()->asArray()->all(), 'name', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Taban storage', 'id' => 'grid-cardex-search-storage']
        ],
        [
            'attribute' => 'product',
            'label' => 'محصول',
            'value' => function ($model) {
                if ($model->product0) {
                    return $model->product0->name;
                } else {
                    return NULL;
                }
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Product::find()->asArray()->all(), 'name', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Taban storage product', 'id' => 'grid-cardex-search-product']
        ],
        [
            'attribute' => 'date',
            'value' => function ($model) {
                /**
                 * @var $model Cardex
                 */
                return (new AmintadoFunctions())->convertdate($model->date);
            }
        ],
        'description',
        [
            'attribute' => 'change',
            'value' => function ($model) {
                /**
                 * @var $model Cardex
                 */
                if ((float)$model->change > 0) {
                    return '<span class="label label-success">+' . $model->change . '</span>';
                } else {
                    return '<span class="label label-danger">' . $model->change . '</span>';
                }
            },
            'format' => 'html'
        ],

        [
            'attribute' => 'stock',
            'value' => function ($model) {
                /**
                 * @var $model Cardex
                 */
                if ($model->storage>0){
                    return '<span class="label label-success">' . $model->stock . '</span>';
                }else{
                    return '<span class="label label-danger">' . $model->stock . '</span>';
                }
            },
            'format'=>'html'
        ],
        'username',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}{document}',
            'buttons' =>
                [
                    'document' => function ($url, $model) {
                        /**
                         * @var $model Cardex
                         */
                        if (!empty($model->model)){
                            $moduleID=Yii::$app->controller->module->id;
                            return '<a target="_blank" href="'.Yii::$app->urlManager->createUrl(["/$moduleID/print/view?id=".$model->model]).'"><span class="glyphicon glyphicon-folder-open" title="نمایش سند"></span></a>';
                        }


                    },
                    'filter'=>false
                ]

        ],

    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-cardex']],
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
            ]),
        ],
    ]); ?>

</div>
