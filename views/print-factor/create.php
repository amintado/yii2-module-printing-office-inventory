<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Sprint */

//$this->title = 'Create Sprint';
//$this->params['breadcrumbs'][] = ['label' => 'Sprints', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sprint-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
