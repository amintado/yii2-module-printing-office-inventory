<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Storage */

?>
<div class="storage-create">

    <h1><?= Html::encode(Yii::t('atpinventory', 'Create Storage')) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
