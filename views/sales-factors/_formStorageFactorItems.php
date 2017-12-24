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
            'label' => 'Taban storage product',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\amintado\pinventory\models\Product::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
                'options' => ['placeholder' => 'Choose Taban storage product'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'price' => ['type' => TabularForm::INPUT_TEXT],
        'tax' => ['type' => TabularForm::INPUT_TEXT],
        'discount' => ['type' => TabularForm::INPUT_TEXT],
        'total' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowStorageFactorItems(' . $key . '); return false;', 'id' => 'storage-factor-items-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Taban Storage Factor Items', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowStorageFactorItems()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

