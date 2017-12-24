<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Product */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'نام کالا را وارد کنید...']) ?>

    <?= $form->field($model, 'descrition')->widget(CKEditor::className()) ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('common', 'StorageItems')),
            'content' => $this->render('_formStorageItems', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->storageItems),
            ]),
        ],
    ];
//    echo kartik\tabs\TabsX::widget([
//        'items' => $forms,
//        'position' => kartik\tabs\TabsX::POS_ABOVE,
//        'encodeLabels' => false,
//        'pluginOptions' => [
//            'bordered' => true,
//            'sideways' => true,
//            'enableCache' => false,
//        ],
//    ]);
    ?>
    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'ثبت') : Yii::t('common', 'بروزرسانی'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'create'): ?>

    <?php endif; ?>
        <?= Html::a(Yii::t('common', 'لغو'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
