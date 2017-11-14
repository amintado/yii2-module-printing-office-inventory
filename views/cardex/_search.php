<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\CardexSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-cardex-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'date')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Date',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) ?>

    <?= $form->field($model, 'change')->textInput(['placeholder' => 'Change']) ?>

    <?= $form->field($model, 'module')->textInput(['maxlength' => true, 'placeholder' => 'Module']) ?>

    <?php /* echo $form->field($model, 'model')->textInput(['maxlength' => true, 'placeholder' => 'Model']) */ ?>

    <?php /* echo $form->field($model, 'uid')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Users::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose Taban users'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Username']) */ ?>

    <?php /* echo $form->field($model, 'stock')->textInput(['placeholder' => 'Stock']) */ ?>

    <?php /* echo $form->field($model, 'storage')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Storage::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
        'options' => ['placeholder' => 'Choose Taban storage'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'product')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\StorageProduct::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
        'options' => ['placeholder' => 'Choose Taban storage product'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
