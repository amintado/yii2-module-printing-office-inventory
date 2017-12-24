<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Factor */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'StorageFactorItems', 
        'relID' => 'storage-factor-items', 
        'value' => \yii\helpers\Json::encode($model->storageFactorItems),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="factor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

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
        'data' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose Taban users'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'company')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Peoples::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
        'options' => ['placeholder' => 'Choose Taban storage peoples'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'sum')->textInput(['maxlength' => true, 'placeholder' => 'Sum']) ?>

    <?= $form->field($model, 'status')->textInput(['placeholder' => 'Status']) ?>

    <?= $form->field($model, 'storage')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Storage::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
        'options' => ['placeholder' => 'Choose Taban storage'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'tax')->textInput(['maxlength' => true, 'placeholder' => 'Tax']) ?>

    <?= $form->field($model, 'discount')->textInput(['maxlength' => true, 'placeholder' => 'Discount']) ?>

    <?= $form->field($model, 'transportation')->textInput(['maxlength' => true, 'placeholder' => 'Transportation']) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) ?>

    <?= $form->field($model, 'paymentPrice')->textInput(['maxlength' => true, 'placeholder' => 'PaymentPrice']) ?>

    <?= $form->field($model, 'module')->textInput(['placeholder' => 'Module']) ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('StorageFactorItems'),
            'content' => $this->render('_formStorageFactorItems', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->storageFactorItems),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'ثبت' : 'بروزرسانی', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('لغو و بستن فرم', '#' , ['class'=> 'btn btn-danger', 'id' => 'cancel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
