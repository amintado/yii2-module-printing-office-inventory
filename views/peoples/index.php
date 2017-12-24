<?php

/* @var $this yii\web\View */
/* @var $searchModel amintado\pinventory\models\PeoplesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'مدیریت مراکز';
$this->params['breadcrumbs'][] = $this->title;
$j=<<<JS

$('#createbtn').click(function(e) {
e.preventDefault();
$('#CreateModal').modal('show');
});
$('#cancel').click(function(e) {
e.preventDefault();
$('#CreateModal').modal('hide');
});
JS;
$this->registerJs($j);
Modal::begin(['id' => 'CreateModal','header' => '<h3>ثبت مرکز جدید</h3>']);
echo $this->render('create',['model'=> $model]);
Modal::end();
?>
<div class="peoples-index">

    <p>
        <?= Html::a('ثبت مرکز جدید', ['#'], ['class' => 'btn btn-success','id'=>'createbtn']) ?>

    </p>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'telephone',
        'economic_code',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{save-as-new} {view} {update} {delete}',
            'buttons' => [
                'save-as-new' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-copy"></span>', $url, ['title' => 'Save As New']);
                },
            ],
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-peoples']],
        'panel' => [
            'type' => GridView::TYPE_ACTIVE,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'استخراح همه ی اطلاعات',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">استخراج همه ی اطلاعات</li>',
                    ],
                ],
            ]) ,
        ],
    ]); ?>

</div>
