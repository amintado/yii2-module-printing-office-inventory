<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Storage */

$this->title = Yii::t('atpinventory', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('atpinventory', 'Storage'),
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('atpinventory', 'Storages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('atpinventory', 'Update');
?>
<div class="storage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
