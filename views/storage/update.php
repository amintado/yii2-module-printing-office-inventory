<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Storage */
/**
 * @var $products
 * @var $items
 */
$this->title = 'بروزرسانی انبار '. ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('atpinventory', 'Storages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('atpinventory', 'Update');
?>
<div class="storage-update">


    <?= $this->render('_form', [
        'update' => true,
        'model' => $model,
        'items'=> $items,
        'products'=> $products
    ]) ?>

</div>
