<div class="form-group" id="add-storage-items">
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
    'formName' => 'StorageItems',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'zink_no' => ['type' => TabularForm::INPUT_TEXT],
        'circulation' => ['type' => TabularForm::INPUT_TEXT],
        'frame_count' => ['type' => TabularForm::INPUT_TEXT],
        'zink_count' => ['type' => TabularForm::INPUT_TEXT],
        'dimentions' => ['type' => TabularForm::INPUT_TEXT],
        'one_and_two' => ['type' => TabularForm::INPUT_TEXT],
        'color_count' => ['type' => TabularForm::INPUT_TEXT],
        'color_5' => ['type' => TabularForm::INPUT_TEXT],
        'inventory' => ['type' => TabularForm::INPUT_TEXT],
        'sex' => ['type' => TabularForm::INPUT_TEXT],
        'date' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
                'saveFormat' => 'php:Y-m-d H:i:s',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => Yii::t('common', 'Choose Date'),
                        'autoclose' => true,
                    ]
                ],
            ]
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('common', 'Delete'), 'onClick' => 'delRowStorageItems(' . $key . '); return false;', 'id' => 'storage-items-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('common', 'Add Taban Storage Items'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowStorageItems()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

