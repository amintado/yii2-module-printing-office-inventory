<?php

use amintado\pinventory\assets\PinventoryAsset;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Sprint */
PinventoryAsset::register($this);

?>
<style>
    .modal-content{
        width: 90vw !important;
        right: auto;
        left: auto;
        margin-right: auto;
        margin-left: auto;
        padding-left: 0;
        padding-right: 0;
    }
    .modal-dialog{
        width: 90vw !important;
    }
</style>
<div class="sprint-create" >

    <h1><?= Html::encode(Yii::t('atpinventory', 'Create Sprint')) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
