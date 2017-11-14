<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Cardex */

$this->title = 'Save As New Cardex: '. ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Cardexes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="cardex-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
