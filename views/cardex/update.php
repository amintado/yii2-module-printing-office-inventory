<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Cardex */

$this->title = 'Update Cardex: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Cardexes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cardex-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
