<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Product */

$this->title = Yii::t('common', 'افزودن کالای مصرفی');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'مدیریت کالاها'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
