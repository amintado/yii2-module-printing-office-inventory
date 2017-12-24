<div class="form-group" id="add-storage-factor-items">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'StorageFactorItems',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'product' => [
            'label' => 'نام کالا',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Product::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
                'options' => ['placeholder' => 'انتخاب کالا','onchange'=>"pselect(this)"],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'total' => ['type' => TabularForm::INPUT_TEXT,'label'=>'تعداد','options'=>['onfocus'=>'ptotal(this)']],
        'price' => ['type' => TabularForm::INPUT_TEXT,'label'=>'قیمت هر عدد','options'=>['onfocus'=>'pprice(this)']],
        'tax' => ['type' => TabularForm::INPUT_TEXT,'label'=>'مالیات','options'=>['onfocus'=>'ptax(this)']],
        'discount' => ['type' => TabularForm::INPUT_TEXT,'label'=>'تخفیف','options'=>['onfocus'=>'pdiscount(this)']],
        'sum'=>['type'=>TabularForm::INPUT_TEXT,'options'=>["disabled"=>"disabled"],'label'=>'جمع','oninput'=>'pdiscount(this)'],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash btn btn-danger"></i>', '#', ['title' =>  'حذف این ردیف', 'onClick' => 'delRowStorageFactorItems(' . $key . '); return false;', 'id' => 'storage-factor-items-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowStorageFactorItems()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

