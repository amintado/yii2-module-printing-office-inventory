<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Storage */
/* @var $form yii\widgets\ActiveForm */

$j=<<<JS
$('#cancle').click(function(e) {
  e.preventDefault();
  $('#Createmodal').modal('hide');
});
JS;
$this->registerJs($j,View::POS_END);
?>

<div class="storage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('atpinventory', 'Create') : Yii::t('atpinventory', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>

        <?= Html::a(Yii::t('atpinventory', 'Cancel'), ['#'] , ['class'=> 'btn btn-danger','id'=>'cancle']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
