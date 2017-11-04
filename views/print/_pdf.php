<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Sprint */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Sprints'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sprint-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('common', 'Sprint').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'storage',
        'product',
        'zink_number',
        'tiraj',
        'frame_count',
        'zink_count',
        'Dimensions',
        'one_two',
        'color_count',
        'five_color',
        'page_count',
        'date',
        'uid',
        'description:ntext',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
