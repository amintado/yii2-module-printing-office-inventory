<?php

use amintado\base\AmintadoFunctions;
use amintado\pinventory\models\Cardex;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Cardex */

$this->title = 'مشاهده ی جزئیات کاردکس شماره '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cardexes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cardex-view">

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
            ) ?>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'date',
                'value' => function ($model) {
                    /**
                     * @var $model Cardex
                     */
                    return (new AmintadoFunctions())->convertdate($model->date);
                }
            ],

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
            'username',
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

            [
                'attribute' => 'storage0.name',
                'label' => 'انبار',
            ],
            [
                'attribute' => 'product0.name',
                'label' => 'کالا',
            ],
            [
                'attribute' => 'description',
                'format' => 'html'
            ],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>







</div>
