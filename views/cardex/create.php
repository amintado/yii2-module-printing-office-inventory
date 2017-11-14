<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Cardex */

//$this->title = 'Create Cardex';
//$this->params['breadcrumbs'][] = ['label' => 'Cardexes', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cardex-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
