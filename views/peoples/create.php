<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Peoples */

//$this->title = 'Create Peoples';
//$this->params['breadcrumbs'][] = ['label' => 'Peoples', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peoples-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
