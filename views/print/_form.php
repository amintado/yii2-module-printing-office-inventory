<?php

use amintado\pinventory\models\Product;
use amintado\pinventory\models\ProductSearch;
use amintado\pinventory\models\Storage;
use amintado\pinventory\models\StorageItems;
use dosamigos\ckeditor\CKEditor;
use kartik\widgets\Select2;
use phpDocumentor\Reflection\FqsenResolver;
use yii\base\View;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\redactor\widgets\Redactor;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Sprint */
/* @var $form yii\widgets\ActiveForm */
$csrf = Yii::$app->request->csrfToken;
$id = Yii::$app->controller->module->id;
$url = Yii::$app->urlManager->createUrl([$id . '/print/productlist']);
if (empty($update)) {
    $j = <<<JS
    var dat='';
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
                       $('#w1').datepicker('show');
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
    $('#w1').datepicker('show');
        if(e.which == 13) {
            e.preventDefault();
            
                             $('#sprint-tiraj').focus();
                          }
        });
$('#sprint-tiraj').on('keypress',function(e) {
    $('#w1').datepicker('show');
      if(e.which == 13) {
          e.preventDefault();
                             $('#sprint-frame_count').focus();
                        }
});

$('#sprint-frame_count').on('keypress',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-zink_count').focus();
                        }
});

$('#sprint-zink_count').on('keypress',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-dimensions').focus();
                             $('#sprint-dimensions').select2('open');
                        }
});

$('#sprint-dimensions').on('select2:change',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-one_two').focus();
                             $('#sprint-one_two').select2('open');
                        }
});

$('#sprint-one_two').on('keypress',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-color_count').focus();
                        }
});

$('#sprint-color_count').on('keypress',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-five_color').focus();
                        }
});

$('#sprint-five_color').on('keypress',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-page_count').focus();
                      }
});

$('#sprint-five_color').on('keypress',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-page_count').focus();
                      }
});

$('#sprint-page_count').on('keypress',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
                e.preventDefault();

        
                             $('#sprint-description').focus();
                      }
});
$('.modal-body').click(function() {
  $('#w1').datepicker('show');
});

$('.modal-header').click(function() {
  $('#w1').datepicker('show');
});

$('.modal-content').click(function() {
  $('#w1').datepicker('show');
});




JS;
} else {
    $j = <<<JS
var amin='';
$(document).ready(function() {
  $('select').select2();
  $('#CreateModal').removeAttr('tabindex');
  $('#w1').datepicker('show');
});

$('#cancel').click(function(e) {
  e.preventDefault();
  
  $('#CreateModal').modal('hide');
});
$('#sprint-storage').on('select2:selecting',function(n){
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
                       $('#w1').datepicker('show');
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
    $('#w1').datepicker('show');
        if(e.which == 13) {
            e.preventDefault();
            
                             $('#sprint-tiraj').focus();
                          }
        });
$('#sprint-tiraj').on('keypress',function(e) {
    $('#w1').datepicker('show');
      if(e.which == 13) {
          e.preventDefault();
                             $('#sprint-frame_count').focus();
                        }
});

$('#sprint-frame_count').on('keypress',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-zink_count').focus();
                        }
});

$('#sprint-zink_count').on('keypress',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-dimensions').focus();
                             $('#sprint-dimensions').select2('open');
                        }
});

$('#sprint-dimensions').on('select2:change',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-one_two').focus();
                             $('#sprint-one_two').select2('open');
                        }
});

$('#sprint-one_two').on('keypress',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-color_count').focus();
                        }
});

$('#sprint-color_count').on('keypress',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-five_color').focus();
                        }
});

$('#sprint-five_color').on('keypress',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-page_count').focus();
                      }
});

$('#sprint-five_color').on('keypress',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
        e.preventDefault();
                             $('#sprint-page_count').focus();
                      }
});

$('#sprint-page_count').on('keypress',function(e) {
    $('#w1').datepicker('show');
    if(e.which == 13) {
                e.preventDefault();

        
                             $('#sprint-description').focus();
                      }
});
$('.modal-body').click(function() {
  $('#w1').datepicker('show');
});

$('.modal-header').click(function() {
  $('#w1').datepicker('show');
});

$('.modal-content').click(function() {
  $('#w1').datepicker('show');
});




JS;
}

$this->registerJs($j, \yii\web\View::POS_END)
?>

<style>
    .modal-open .select2-dropdown {
        z-index: 10060;
    }

    .modal-open .select2-close-mask {
        z-index: 10055;
    }

    .datepicker-rtl {
        right: auto !important;
        /*left: auto !important;*/
    }

    .cke_dialog_ui_input_select {
        width: 100%;
    }

    .select2-container {
        z-index: 10010;
    }

    .select2-container .select2-selection--single {
        position: relative;
    }



    #w1 {
        opacity: 0;
    }
</style>
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
            <?php
            if (!empty($update)) {

                echo $form->field($model, 'product')->widget(Select2::className(), [

                    'data' => ArrayHelper::map(Product::find()->where(['name' => $model->product])->all(), 'name', 'name'),

                ]);
            } else {
                $data=ArrayHelper::map(Storage::find()->all(), 'name', 'name');
                $key='';
                foreach ($data as $key => $value){
                    break;
                }
                $pnames=ArrayHelper::getColumn(StorageItems::find()->where(['storage'=>$key])->all(),'product');
                echo $form->field($model, 'product')->widget(Select2::className(), [

                    'data' => ArrayHelper::map(Product::find()->where(['name' => $pnames])->all(), 'name', 'name'),

                ]);
            }
            ?>

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
            <?= $form->field($model, 'Dimensions')->widget(Select2::className(),
                [
                    'data' =>
                        [
                            '60*90' => '60*90',
                            '100*70' => '100*70'
                        ]
                ]
            ) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'one_two')->checkbox() ?>

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
            <?= $form->field($model, 'date')->widget(faravaghi\jalaliDatePicker\jalaliDatePicker::classname(), [
                'options' => [
                    'format' => 'yyyy/mm/dd',
                    'viewformat' => 'yyyy/mm/dd',
                    'placement' => 'left',
                    'todayBtn' => 'linked',
                ]

            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <?=  $form->field($model, 'description')->textarea() ?>
        </div>
    </div>


    <div class="form-group">
        <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
            <?= Html::submitButton(Yii::t('atpinventory', 'Create'), ['class' => 'btn btn-success']) ?>
        <?php endif; ?>

        <?= Html::a(Yii::t('atpinventory', 'Cancel'), ['#'], ['class' => 'btn btn-danger', 'id' => 'cancle']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
