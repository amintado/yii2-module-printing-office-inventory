<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Sprint */

$this->title = Yii::t('atpinventory', 'Update {modelClass}: ', [
    'modelClass' => 'Sprint',
]) . ' ' . $model->id;

?>
<div class="sprint-update">

    <h1><?= Html::encode(Yii::t('atpinventory', 'Update')) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'update'=> $update
    ]) ?>

</div>
