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

/* @var $this yii\web\View */
/* @var $psearchModel amintado\pinventory\models\ProductSearch */
/* @var $pdataProvider yii\data\ActiveDataProvider */
/* @var $pgridColumn */

use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
?>
<div class="product-index">
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'descrition:ntext',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{save-as-new} {view} {update} {delete}',
            'buttons' => [
                'save-as-new' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-copy"></span>', $url, ['title' => 'Save As New']);
                },
            ],
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $pdataProvider,
        'filterModel' => $psearchModel,
        'columns' => $pgridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-product']],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => false
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $pdataProvider,
                'columns' => $pgridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => Yii::t('atpinventory', 'Export All'),
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">'. Yii::t('atpinventory', 'Export All').'</li>',
                    ],
                ],
            ]) ,
        ],
    ]); ?>

</div>
