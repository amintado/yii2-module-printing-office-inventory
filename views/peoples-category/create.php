<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\PeoplesCategory */

//$this->title = 'Create Peoples Category';
//$this->params['breadcrumbs'][] = ['label' => 'Peoples Categories', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peoples-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
