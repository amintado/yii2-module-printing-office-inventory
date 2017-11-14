<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Cardex */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Cardexes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cardex-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Cardex'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'date',
        'description',
        'change',
        'module',
        'model',
        [
                'attribute' => 'u.username',
                'label' => 'Uid'
            ],
        'username',
        'stock',
        [
                'attribute' => 'storage0.name',
                'label' => 'Storage'
            ],
        [
                'attribute' => 'product0.name',
                'label' => 'Product'
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
