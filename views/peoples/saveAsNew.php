<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Peoples */

$this->title = 'Save As New Peoples: '. ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Peoples', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="peoples-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
