<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\PeoplesCategory */

$this->title = 'Update Peoples Category: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Peoples Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="peoples-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
