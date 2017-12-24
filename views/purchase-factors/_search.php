<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\PurchaseFactorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-factor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'serial')->textInput(['maxlength' => true, 'placeholder' => 'Serial']) ?>

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

    <?= $form->field($model, 'register_time')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Register Time',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'uid')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Users::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose Taban users'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php /* echo $form->field($model, 'company')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\StoragePeoples::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
        'options' => ['placeholder' => 'Choose Taban storage peoples'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'sum')->textInput(['maxlength' => true, 'placeholder' => 'Sum']) */ ?>

    <?php /* echo $form->field($model, 'status')->textInput(['placeholder' => 'Status']) */ ?>

    <?php /* echo $form->field($model, 'storage')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Storage::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
        'options' => ['placeholder' => 'Choose Taban storage'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'tax')->textInput(['maxlength' => true, 'placeholder' => 'Tax']) */ ?>

    <?php /* echo $form->field($model, 'discount')->textInput(['maxlength' => true, 'placeholder' => 'Discount']) */ ?>

    <?php /* echo $form->field($model, 'transportation')->textInput(['maxlength' => true, 'placeholder' => 'Transportation']) */ ?>

    <?php /* echo $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) */ ?>

    <?php /* echo $form->field($model, 'paymentPrice')->textInput(['maxlength' => true, 'placeholder' => 'PaymentPrice']) */ ?>

    <?php /* echo $form->field($model, 'module')->textInput(['placeholder' => 'Module']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
