<?php

use amintado\pinventory\assets\PinventoryAsset;
use amintado\pinventory\models\Product;
use amintado\pinventory\models\StorageItems;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

PinventoryAsset::register($this);
/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Storage */
/* @var $form yii\widgets\ActiveForm */
/**
 * @var $products Product[]
 * @var $items StorageItems[]
 */
$j = <<<JS




$('.searchable').multiSelect({
  selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='جست و جو'>",
  selectionHeader: "<input type='text' class='search-input' autocomplete='off'  placeholder='جست و جو'>",
  afterInit: function(ms){
    var that = this,
        \$selectableSearch = that.\$selectableUl.prev(),
        \$selectionSearch = that.\$selectionUl.prev(),
        selectableSearchString = '#'+that.\$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
        selectionSearchString = '#'+that.\$container.attr('id')+' .ms-elem-selection.ms-selected';

    that.qs1 = \$selectableSearch.quicksearch(selectableSearchString)
    .on('keydown', function(e){
      if (e.which === 40){
        that.\$selectableUl.focus();
        return false;
      }
    });

    that.qs2 = \$selectionSearch.quicksearch(selectionSearchString)
    .on('keydown', function(e){
      if (e.which == 40){
        that.\$selectionUl.focus();
        return false;
      }
    });
  },
  afterSelect: function(){
    this.qs1.cache();
    this.qs2.cache();
  },
  afterDeselect: function(){
    this.qs1.cache();
    this.qs2.cache();
  }
});



$('#cancle').click(function(e) {
  e.preventDefault();
  $('#Createmodal').modal('hide');
});


$(document).ready(function() {
    //alert($('.ms-selectable').html())
   $('.ms-container').css('width','auto');
   $('.search-input').css('width','100%');
   $('.ms-list').css('max-height','400px');
   $('.ms-list').css('min-height','400px');
   $('.ms-list').css('border-radius','0 0 10px 10px');
   $('.ms-list').css('border-top','none');
   

})
JS;
$this->registerJs($j, View::POS_END);
$c = <<<CSS
* { box-sizing:border-box; }

/* basic stylings ------------------------------------------ */
body 				 { background:url(https://scotch.io/wp-content/uploads/2014/07/61.jpg); }
.container 		{ 
  font-family:'Roboto';
  width:600px; 
  margin:30px auto 0; 
  display:block; 
  background:#FFF;
  padding:10px 50px 50px;
}
h2 		 { 
  text-align:center; 
  margin-bottom:50px; 
}
h2 small { 
  font-weight:normal; 
  color:#888; 
  display:block; 
}
.footer 	{ text-align:center; }
.footer a  { color:#53B2C8; }

/* form starting stylings ------------------------------- */
.group 			  { 
  position:relative; 
  margin-bottom:45px; 
}
input 				{
  font-size:18px;
  padding:10px 10px 10px 5px;
  display:block;
  width:300px;
  border:none;
  border-bottom:1px solid #757575;
}
input:focus 		{ outline:none; }

/* LABEL ======================================= */
label 				 {
  color:#999; 
  font-size:18px;
  font-weight:normal;
  position:absolute;
  pointer-events:none;
  left:5px;
  top:10px;
  transition:0.2s ease all; 
  -moz-transition:0.2s ease all; 
  -webkit-transition:0.2s ease all;
}

/* active state */
input:focus ~ label, input:valid ~ label 		{
  top:-20px;
  font-size:14px;
  color:#5264AE;
}

/* BOTTOM BARS ================================= */
.bar 	{ position:relative; display:block; width:300px; }
.bar:before, .bar:after 	{
  content:'';
  height:2px; 
  width:0;
  bottom:1px; 
  position:absolute;
  background:#5264AE; 
  transition:0.2s ease all; 
  -moz-transition:0.2s ease all; 
  -webkit-transition:0.2s ease all;
}
.bar:before {
  left:50%;
}
.bar:after {
  right:50%; 
}

/* active state */
input:focus ~ .bar:before, input:focus ~ .bar:after {
  width:50%;
}

/* HIGHLIGHTER ================================== */
.highlight {
  position:absolute;
  height:60%; 
  width:100px; 
  top:25%; 
  left:0;
  pointer-events:none;
  opacity:0.5;
}

/* active state */
input:focus ~ .highlight {
  -webkit-animation:inputHighlighter 0.3s ease;
  -moz-animation:inputHighlighter 0.3s ease;
  animation:inputHighlighter 0.3s ease;
}

/* ANIMATIONS ================ */
@-webkit-keyframes inputHighlighter {
	from { background:#5264AE; }
  to 	{ width:0; background:transparent; }
}
@-moz-keyframes inputHighlighter {
	from { background:#5264AE; }
  to 	{ width:0; background:transparent; }
}
@keyframes inputHighlighter {
	from { background:#5264AE; }
  to 	{ width:0; background:transparent; }
}
CSS;

$this->registerCss($c);
?>
<div class="storage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'نام انبار را بنویسید...']) ?>





    <?php

    if (!empty($update)){

    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">لیست کالاها</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center">کالاهای داخل انبار</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">کل کالاهای سیستم</div>
                        </div>
                    </div>
                    <select multiple="" class="searchable" name="Storage[products][]"
                            style="position: absolute; left: -9999px;" id="370multiselect">
                        <?php
                        foreach ($products as $key => $value) {
                            echo '<option value="' . urlencode($value->name) . '">' . $value->name . '</option>';
                        }
                       
                        foreach ($items as $key => $value) {
                            echo '<option value="' . urlencode($value->product) . '" selected="selected">' . $value->product . '</option>';
                        }
                        ?>

                    </select>
                </div>

                <!--    <div class="col-md-2" id="icon">-->

            </div>

        </div>
    </div>
</div>

<?php
}
?>


<div class="form-group">
    <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('atpinventory', 'Create') : Yii::t('atpinventory', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>

    <?= Html::a(Yii::t('atpinventory', 'Cancel'), ['#'], ['class' => 'btn btn-danger', 'id' => 'cancle']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
