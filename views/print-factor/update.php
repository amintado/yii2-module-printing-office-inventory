<?php
/*******************************************************************************
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 ******************************************************************************/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Sprint */

$this->title = 'ثبت اطلاعات لیتوگرافی چاپ شماره' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sprints', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sprint-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
