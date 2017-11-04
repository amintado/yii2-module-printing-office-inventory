<?php

use amintado\pinventory\models\Product;
use amintado\pinventory\models\ProductSearch;
use amintado\pinventory\models\Storage;
use kartik\widgets\Select2;
use phpDocumentor\Reflection\FqsenResolver;
use yii\base\View;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Sprint */
/* @var $form yii\widgets\ActiveForm */
$csrf = Yii::$app->request->csrfToken;
$id = Yii::$app->controller->module->id;
$url = Yii::$app->urlManager->createUrl([$id . '/print/productlist']);
$j = <<<JS
var amin='';
$(document).ready(function() {
  $('select').select2();
  $('#CreateModal').removeAttr('tabindex');
});

$('#cancel').click(function(e) {
  e.preventDefault();
  
  $('#CreateModal').modal('hide');
});
$('#sprint-storage').on('select2:select',function(n){
    var dat=n.params.data;  
    $.ajax({
              method: 'POST',
              url: '$url',
              format:'JSON',
              data: {_csrf: '$csrf',dat:dat.id},
              success: function (data) {
                 amin=data;
                   $('#pfield').html(data);
                   if (jQuery('#sprint-product').data('select2')) { jQuery('#sprint-product').select2('destroy'); }
jQuery.when(jQuery('#sprint-product').select2(select2_e05632a1)).done(initS2Loading('sprint-product','s2options_d6851687'));
                   setTimeout(function() {
                       $('#sprint-product').select2('open');
                   },2000);
                   
                   $('#sprint-product').on
                   (
                   'select2:select',
                   function(n) {
                        $('#sprint-zink_number').focus();
                                }
                   );

              }
                    
    });
    });
       

$('#sprint-zink_number').on('keypress',function(e) {
    
        if(e.which == 13) {
            e.preventDefault();
                             $('#sprint-tiraj').focus();
                          }
        });
$('#sprint-tiraj').on('keypress',function(e) {
    
      if(e.which == 13) {
          e.preventDefault();
                             $('#sprint-frame_count').focus();
                        }
});

$('#sprint-frame_count').on('keypress',function(e) {
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-zink_count').focus();
                        }
});

$('#sprint-zink_count').on('keypress',function(e) {
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-dimensions').focus();
                        }
});

$('#sprint-dimensions').on('keypress',function(e) {
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-one_two').focus();
                        }
});

$('#sprint-one_two').on('keypress',function(e) {
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-color_count').focus();
                        }
});

$('#sprint-color_count').on('keypress',function(e) {
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-five_color').focus();
                        }
});

$('#sprint-five_color').on('keypress',function(e) {
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-page_count').focus();
                      }
});

$('#sprint-five_color').on('keypress',function(e) {
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-page_count').focus();
                      }
});

$('#sprint-page_count').on('keypress',function(e) {
    if(e.which == 13) {
                e.preventDefault();

        
                             $('#sprint-description').focus();
                      }
});


JS;
$this->registerJs($j, \yii\web\View::POS_END)


?>

<div class="sprint-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-md-4">

            <?= $form->field($model, 'storage')->widget(Select2::className(), [
                'data' => ArrayHelper::map(Storage::find()->all(), 'name', 'name'),
            ]) ?>
        </div>
        <div class="col-md-4" id="pfield">
            <?= $form->field($model, 'product')->widget(Select2::className(), [

                'data' => [],

            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'zink_number')->textInput(['maxlength' => true, 'placeholder' => 'Zink Number']) ?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'tiraj')->textInput(['placeholder' => 'Tiraj']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'frame_count')->textInput(['placeholder' => 'Frame Count']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'zink_count')->textInput(['placeholder' => 'Zink Count']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'Dimensions')->textInput(['maxlength' => true, 'placeholder' => 'Dimensions']) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'one_two')->textInput(['placeholder' => 'One Two']) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'color_count')->textInput(['placeholder' => 'Color Count']) ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'five_color')->textInput(['maxlength' => true, 'placeholder' => 'Five Color']) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'page_count')->textInput(['placeholder' => 'Page Count']) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model,'date')->widget(faravaghi\jalaliDatePicker\jalaliDatePicker::classname(),[
                'format' => 'yyyy/mm/dd',
                'viewformat' => 'yyyy/mm/dd',
                'placement' => 'left',
                'todayBtn' => 'linked',
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        </div>
    </div>



    <div class="form-group">
        <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
            <?= Html::submitButton( Yii::t('atpinventory', 'Create'), ['class' => 'btn btn-success']) ?>
        <?php endif; ?>

        <?= Html::a(Yii::t('atpinventory', 'Cancel'), ['#'], ['class' => 'btn btn-danger', 'id' => 'cancle']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
