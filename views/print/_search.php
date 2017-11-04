<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\PrintSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-sprint-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'storage')->textInput(['maxlength' => true, 'placeholder' => 'Storage']) ?>

    <?= $form->field($model, 'product')->textInput(['maxlength' => true, 'placeholder' => 'Product']) ?>

    <?= $form->field($model, 'zink_number')->textInput(['maxlength' => true, 'placeholder' => 'Zink Number']) ?>

    <?= $form->field($model, 'tiraj')->textInput(['placeholder' => 'Tiraj']) ?>

    <?php /* echo $form->field($model, 'frame_count')->textInput(['placeholder' => 'Frame Count']) */ ?>

    <?php /* echo $form->field($model, 'zink_count')->textInput(['placeholder' => 'Zink Count']) */ ?>

    <?php /* echo $form->field($model, 'Dimensions')->textInput(['maxlength' => true, 'placeholder' => 'Dimensions']) */ ?>

    <?php /* echo $form->field($model, 'one_two')->textInput(['placeholder' => 'One Two']) */ ?>

    <?php /* echo $form->field($model, 'color_count')->textInput(['placeholder' => 'Color Count']) */ ?>

    <?php /* echo $form->field($model, 'five_color')->textInput(['maxlength' => true, 'placeholder' => 'Five Color']) */ ?>

    <?php /* echo $form->field($model, 'page_count')->textInput(['placeholder' => 'Page Count']) */ ?>

    <?php /* echo $form->field($model, 'date')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('common', 'Choose Date'),
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'uid')->textInput(['placeholder' => 'Uid']) */ ?>

    <?php /* echo $form->field($model, 'description')->textarea(['rows' => 6]) */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('common', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
