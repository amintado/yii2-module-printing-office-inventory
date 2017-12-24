<?php

use amintado\pinventory\assets\PinventoryaccountingAsset;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Factor */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'StorageFactorItems',
        'relID' => 'storage-factor-items',
        'value' => \yii\helpers\Json::encode($model->storageFactorItems),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
PinventoryaccountingAsset::register($this);
$js = <<<JS
var amin='';
var mode='$mode';
var total=0;
var errors=0;

        $(document).on('keydown',function(e) {
            if(e.which==107){
                e.preventDefault();
                 addRowStorageFactorItems();
            }
            if(e.which==27){
                $('#factor-tax').focus();
            }
          console.log(e.which);
        });
        $('.main-sidebar').remove();
        $('.main-header').remove();
        $('.main-footer').remove();
        $('.content-wrapper').css('margin-right','0px');
        $('#factor-serial').focus();
        $('#factor-serial').on('keydown',function(e) {
           
            if (e.which==13){
                 e.preventDefault();
               $('#factor-date').focus();                
            }         
        });
        $('#factor-date').on('keydown',function(e) {
           
            if (e.which==13){
                 e.preventDefault();
               $('#factor-company').select2('open');                
               $('#factor-company').focus();                
            }         
        });
        $('#factor-company').on('select2:select',function(e) {
          
              e.preventDefault();
              $('#factor-storage').select2('open');
              $('#factor-storage').focus();
          
        });
        $('#factor-storage').on('select2:select',function(e) {
          
              e.preventDefault();
              
              $('#factor-description').focus();
          
        });
        $('#factor-description').on('keydown',function(e) {
          if (e.which==13){
              e.preventDefault();
              addRowStorageFactorItems();
              
          }
        });

        
        $('#factor-tax').on('keyup',function(e) {
           
      calculate();
    });
        $('#factor-discount').on('keyup',function(e) {
      calculate();
    });
        $('#factor-transportation').on('keyup',function(e) {
      calculate();
    });
  
        $('#factor-tax').on('keydown',function(e) {
        if(e.which==13){
            e.preventDefault();
             var tax=$('#factor-tax');
    if(tax.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null | tax.val()<0){
        error(tax,'لطفا مقدار مالیات را به طور صحیح وارد کنید');
        //error(tax);
    }else{
        tax=parseFloat(tax.val()).toFixed(3);
        if (isNaN(tax)){
            error(tax,'لطفا مقدار مالیات را به طور صحیح وارد کنید');
        }else{
            
            error('#factor-tax');
            $('#factor-discount').focus();
        }
    }
        }
        calculate();
    });
        $('#factor-discount').on('keydown',function(e) {
      if(e.which==13){
          e.preventDefault();
          var discount=$('#factor-discount');
    if(discount.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null | discount<0){
        error(discount,'لطفا مقدار مالیات را به طور صحیح وارد کنید');
        //error(discount);
    }else{
        discount=parseFloat(discount.val()).toFixed(3);
        if (isNaN(discount)){
            error(discount,'لطفا مقدار مالیات را به طور صحیح وارد کنید');
        }else{
            error('#factor-discount');
            $('#factor-transportation').focus();
        }
    }
    
      }
      calculate();
    });
        $('#factor-transportation').on('keydown',function(e) {
      if(e.which==13){
          var transportation=$('#factor-transportation');
    if(transportation.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null |transportation<0){
        error(transportation,'لطفا مقدار مالیات را به طور صحیح وارد کنید');
       // error(transportation);
    }else{
        transportation=parseFloat(transportation.val()).toFixed(3);
        if (isNaN(transportation)){
            error(transportation,'لطفا مقدار مالیات را به طور صحیح وارد کنید');
        }else{
            error('#factor-transportation');
            $('.btn-success').focus();
        }
    }
      }
      calculate();
    });
  
  
function pselect(v){
       
       setTimeout(function() {
          amin='storagefactoritems-'+getid(v)+'-total';
          amin = document.getElementById(amin).focus();
    },100);
             calculate();  
}
function ptotal(v){
    
    $(v).on('keydown',function(e) {
        if (e.which==13){
            var text='لطفا تعداد را وارد کنید';

            e.preventDefault();
            if($(this).val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null | $(this).val()<=0){
                console.log('تعداد خالی است');
            error(this,text);
            }else{
             var total=parseInt($(this).val());
             if (isNaN(total)){                   
                 error(this,text);
                 }else{
                 $(this).val(total);
                 error(this);
                 $(this).val(accounting.formatMoney($(this).val(), "", 0));

                 amin = 'storagefactoritems-'+getid(this)+'-price';
                 document.getElementById(amin).focus();
                 }
             
               
            }
           
            
            
                var tax=$('#factor-tax');
    if(tax.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null)tax.val(0);
    var discount=$('#factor-discount');
    if(discount.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null)discount.val(0);
    var transportation=$('#factor-transportation');
    if(transportation.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null)transportation.val(0);
   
            }
        if(e.which==46){
           
            $(this).closest( ".kv-tabform-row" ).remove();
        }
            
    });
    $(v).on('keyup',function(e) {
        calculate();
    });
}
function pprice(v){
    
    $(v).on('keydown',function(e) {
        if (e.which==13){
            
            e.preventDefault();
            var text='لطفا مبلغ را به طور صحیح وارد کنید';
            if($(this).val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null | $(this).val()<=0){
                console.log('مبلغ خالی است');
                
            error(this,text);
            }else{
                
                var price=parseFloat($(this).val()).toFixed(3);
             if (isNaN(price)){                   
                 error(this,text);
                 }else{
                 $(this).val(price);
                  error(this);
                   $(this).val(accounting.formatMoney($(this).val(), "", 0));
              amin = 'storagefactoritems-'+getid(this)+'-tax';
              document.getElementById(amin).focus(); 
                 }
                
            
            }
            
            
               var tax=$('#factor-tax');
    if(tax.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null)tax.val(0);
    var discount=$('#factor-discount');
    if(discount.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null)discount.val(0);
    var transportation=$('#factor-transportation');
    if(transportation.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null)transportation.val(0);
   
            }
        if(e.which==46){
           
            $(this).closest( ".kv-tabform-row" ).remove();
        }            
    });
     $(v).on('keyup',function(e) {
        calculate();
    });
}
function ptax(v){
    
    $(v).on('keydown',function(e) {
        if (e.which==13){
            e.preventDefault();
            var text='لطفا مبلغ را به طور صحیح وارد کنید';
            if($(this).val()<0){
            
            error(this,text);
            $(this).val(0);
            }else{
                
                var tax=parseFloat($(this).val()).toFixed(3);
             if (isNaN(tax)){                   
                 error(this,text);
                 }else{
                 $(this).val(tax);
                  error(this);
                   $(this).val(accounting.formatMoney($(this).val(), "", 0));
                 amin = 'storagefactoritems-'+getid(this)+'-discount';
                 document.getElementById(amin).focus();
                 }
                
                
                
                
             
            }
            if($(this).val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null){
                $(this).val(0);
                amin = 'storagefactoritems-'+getid(this)+'-discount';
                document.getElementById(amin).focus();
                error(this);
            }
            
            
            
            
            
                var tax=$('#factor-tax');
    if(tax.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null)tax.val(0);
    var discount=$('#factor-discount');
    if(discount.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null)discount.val(0);
    var transportation=$('#factor-transportation');
    if(transportation.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null)transportation.val(0);
   
            }
        if(e.which==46){
           
            $(this).closest( ".kv-tabform-row" ).remove();
        }            
    });
     $(v).on('keyup',function(e) {
        calculate();
    });
}
function pdiscount(v){
    
    $(v).on('keydown',function(e) {
        if (e.which==13){
            e.preventDefault();
             var text='لطفا مبلغ را به طور صحیح وارد کنید';
            if($(this).val()<0){
               
            error(this,text);
            }else{
                
             var discount=parseFloat($(this).val()).toFixed(3);
             if (isNaN(discount)){                   
                 error(this,text);
                 }else{
                 $(this).val(discount);
                  error(this);
                 $(this).text(accounting.formatMoney($(this).val(), "", 0));
                 }
            
            if($('#storagefactoritems-'+(getid(this)+1)+'-product').length==0){
                 addRowStorageFactorItems();
            }else{
                $(this).val(accounting.formatMoney($(this).val(), "", 0));

                $('#storagefactoritems-'+(getid(this)+1)+'-product').select2('open');
                $('#storagefactoritems-'+(getid(this)+1)+'-product').select2('focus');
            }
            
            }
            if($(this).val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null | $(this).val()==0){
                
                $(this).val(0);
                 error(this);
                
                if($('#storagefactoritems-'+(getid(this)+1)+'-product').length==0){
                 addRowStorageFactorItems();
            }else{
                    $(this).val(accounting.formatMoney($(this).val(), "", 0));
                    $('#storagefactoritems-'+(getid(this)+1)+'-product').select2('open');
                $('#storagefactoritems-'+(getid(this)+1)+'-product').select2('focus');
            }
            }    
            
            
            
        
             
                var tax=$('#factor-tax');
    if(tax.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null)tax.val(0);
    var discount=$('#factor-discount');
    if(discount.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null)discount.val(0);
    var transportation=$('#factor-transportation');
    if(transportation.val().match(/^[\-]{0,1}[0-9]+[\.][0-9]+|[\-]{0,1}[0-9]+$/g)==null)transportation.val(0);
   
            }
        if(e.which==46){
           
            $(this).closest( ".kv-tabform-row" ).remove();
        }            
    });
     $(v).on('keyup',function(e) {
        calculate();
    });
}
function getid(id){
    id =$(id).attr('id').toString();
    var a=parseInt(id.match(/\d+/)[0],10);
    if (a<1){
        return 0;
    }else{
        return a;
    }
    return 0;
}
function error(element,text=null) {
    if(text==null){
        $(element).popover("hide");
    }else{
        $(element).popover({title: "<span style='color:red'>خطا</span>", content: "<div style='color:red'>"+text+"</div>", placement: "top",html:true});      
    $(element).popover("show"); 
    }
         
}
function errorCheck(index){
    $('#storagefactoritems-'+index+'-product').select2('close');
    if ($('#storagefactoritems-'+index+'-product').parent().find("select").val().length==0){
        if
        (
            (
        $('#storagefactoritems-'+index+'-total').val()==null | 
        $('#storagefactoritems-'+index+'-total').val()==0    | 
        $('#storagefactoritems-'+index+'-total').val()==''  
            ) |
            (
        $('#storagefactoritems-'+index+'-price').val()==null | 
        $('#storagefactoritems-'+index+'-price').val()==0    | 
        $('#storagefactoritems-'+index+'-price').val()==''
            )            
        )
        {
              $('#storagefactoritems-'+index+'-product').select2('close');
             $('#storagefactoritems-'+index+'-price').closest(".kv-tabform-row").remove();
        }else{
           errors = errors + 1;
        error($('#select2-storagefactoritems-'+index+'-product-container'),'این بخش خالیست'); 
        }
        
    }else{
        error('#select2-storagefactoritems-'+index+'-product-container');
    }
    if 
    (
        $('#storagefactoritems-'+index+'-total').val()==null | 
        $('#storagefactoritems-'+index+'-total').val()==0    | 
        $('#storagefactoritems-'+index+'-total').val()==''
        )
    {
         errors = errors + 1;
         error('#storagefactoritems-'+index+'-total','تعداد کالا درست وارد نشده است')
    }
    
    if 
    (
        $('#storagefactoritems-'+index+'-price').val()==null | 
        $('#storagefactoritems-'+index+'-price').val()==0    | 
        $('#storagefactoritems-'+index+'-price').val()==''
        )
    {
         errors = errors + 1;
         error('#storagefactoritems-'+index+'-price','قیمت کالا درست وارد نشده است')
    }
    
     if 
    (
        $('#storagefactoritems-'+index+'-discount').val()==null | 
        $('#storagefactoritems-'+index+'-discount').val()==0    | 
        $('#storagefactoritems-'+index+'-discount').val()==''
        )
    {
        $('#storagefactoritems-'+index+'-discount').val(0)
    }
    
      if 
    (
        $('#storagefactoritems-'+index+'-tax').val()==null | 
        $('#storagefactoritems-'+index+'-tax').val()==0    | 
        $('#storagefactoritems-'+index+'-tax').val()==''
        )
    {
        $('#storagefactoritems-'+index+'-tax').val(0)
    }
    
     
}
function calculate(){
    errors=0;
    var rows=$('.kv-tabform-row').toArray();
    var sums=0;
    $.each(rows,function(i,l) {
        
        errorCheck(i);
        
        sums=+sums + +computeRow(i);
        //console.log('جمع ها'+sums+' جمع یک ردیف:'+row);
    });
    console.log('errors:'+errors);
     if(errors==0){
            $(':input[type="submit"]').prop('disabled', false);
        }else{
         $(':input[type="submit"]').prop('disabled', true);
        }
    var tax=$('#factor-tax');
    var discount=$('#factor-discount');
    var transportation=$('#factor-transportation');
    
    $('#sumprice').text(accounting.formatMoney(sums, "", 0)+' ریال');
    //  
    sums=+sums -discount.val() + +tax.val() + +transportation.val();
    $('#payprice').text(accounting.formatMoney(sums, "", 0)+' ریال');
    
}
function computeRow(index){
    
     var total = accounting.unformat($('#storagefactoritems-'+index+'-total').val(),'.');
    // if(isNaN(total))$('#storagefactoritems-'+index+'-total').val(0);
     var price = accounting.unformat($('#storagefactoritems-'+index+'-price').val(),'.');
     //if(isNaN(price))$('#storagefactoritems-'+index+'-price').val(0);
     var tax   = accounting.unformat($('#storagefactoritems-'+index+'-tax').val(),'.');
    // if(isNaN(tax))$('#storagefactoritems-'+index+'-tax').val(0);
     var discount=accounting.unformat($('#storagefactoritems-'+index+'-discount').val(),'.');
   
    // if(isNaN(discount))$('#storagefactoritems-'+index+'-discount').val(0);
   
     var sum=(total*price);
     sum=+sum + +tax-discount;
     var sumEl= $('#storagefactoritems-'+index+'-sum').val(accounting.formatMoney(sum, "", 0));
     return sum;
  
}


$(document).ready(function() {
  if (mode =='update'){
      alert('ok');
      calculate();
  }
});
JS;
$this->registerJs($js, View::POS_END);
?>
<style>
    .modal-dialog {
        width: 98vw;
    }

    .content-wrapper {
        background: white;
    }
</style>
<div class="factor-form">

    <?php
    $ModuleId = Yii::$app->controller->module->id;
    $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>
    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'serial')->textInput(['maxlength' => true, 'placeholder' => 'سریال فاکتور']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'date')->widget(MaskedInput::className(),
                [ 'mask' => '9999/99/99','options' => ['style'=>'text-align: left;
direction: ltr;','class'=>'form-control']]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'company')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Peoples::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
                'options' => ['placeholder' => 'انتخاب فروشنده'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'storage')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Storage::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
                'options' => ['placeholder' => 'انتخاب انبار'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'درج توضیحات فاکتور']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            echo $this->render('_formStorageFactorItems', ['row' => \yii\helpers\ArrayHelper::toArray($model->storageFactorItems),
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="panel panel-default">


                                <!-- Table -->
                                <table class="table">

                                    <tbody>
                                    <tr>
                                        <td>جمع کل:</td>
                                        <td id="sumprice">10000 ریال</td>
                                    </tr>
                                    <tr>
                                        <td>مالیات:</td>
                                        <td>
                                            <div class="col-md-9">
                                                <input  id="factor-tax" class="form-control"
                                                       name="Factor[tax]"
                                                       placeholder="" aria-invalid="false" type="text">
                                            </div>
                                            <div class="col-md-3">
                                                ریال
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>تخفیف:</td>
                                        <td>
                                            <div class="col-md-9">
                                                <input  id="factor-discount" class="form-control"
                                                       name="Factor[discount]"
                                                       placeholder="" aria-invalid="false" type="text">
                                            </div>
                                            <div class="col-md-3">ریال</div>


                                        </td>
                                    </tr>
                                    <tr>
                                        <td>هزینه حمل و نقل:</td>
                                        <td>
                                            <div class="col-md-9">
                                                <input  id="factor-transportation"
                                                       class="form-control"
                                                       name="Factor[transportation]" placeholder="" aria-invalid="false"
                                                       type="text">
                                            </div>
                                            <div class="col-md-3">ریال</div>


                                        </td>
                                    </tr>
                                    <tr>
                                        <td>قابل پرداخت:</td>
                                        <td id="payprice">10000 ریال</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'ثبت' : 'بروزرسانی', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','disabled'=>'disabled']) ?>
        <?= Html::a('لغو و بستن فرم', '#', ['class' => 'btn btn-danger', 'id' => 'cancel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
