<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Cardex */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="cardex-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

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

    <?= $form->field($model, 'model')->textInput(['maxlength' => true, 'placeholder' => 'Model']) ?>

    <?= $form->field($model, 'uid')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose Taban users'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Username']) ?>

    <?= $form->field($model, 'stock')->textInput(['placeholder' => 'Stock']) ?>

    <?= $form->field($model, 'storage')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Storage::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
        'options' => ['placeholder' => 'Choose Taban storage'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'product')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Product::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
        'options' => ['placeholder' => 'Choose Taban storage product'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? 'ثبت' : 'بروزرسانی', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'index'): ?>
        <?= Html::submitButton('ایجاد یک کپی', ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a('لغو و بستن فرم', '#' , ['class'=> 'btn btn-danger', 'id' => 'cancel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
