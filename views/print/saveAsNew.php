<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Sprint */

$this->title = Yii::t('common', 'Save As New {modelClass}: ', [
    'modelClass' => 'Sprint',
]). ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Sprints'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Save As New');
?>
<div class="sprint-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
