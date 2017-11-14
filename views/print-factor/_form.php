<?php

use common\models\base\Litography;
use dosamigos\ckeditor\CKEditor;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\User;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Sprint */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="sprint-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">اطلاعات چاپی</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">انبار چاپ:</label>
                                    <?= $model->storage ?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">کالای مصرفی:</label>
                                    <?= $model->product ?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">تیراژ:</label>
                                    <?= $model->tiraj ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">تعداد صفحه:</label>
                                    <?= $model->page_count ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">تعداد فرم:</label>
                                    <?= $model->frame_count ?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ابعاد:</label>
                                    <?= $model->Dimensions ?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">رویه ی چاپ:</label>
                                    <?php
                                    if (empty($model->one_two)){
                                        echo ' چاپ یک رو';
                                    }else{
                                        echo 'چاپ دو رو';
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">تعداد رنگ:</label>
                                    <?= $model->color_count ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">رنگ پنجم:</label>
                                    <?= $model->five_color ?>
                                </div>




                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">اطلاعات زینک</div>
                            <div class="panel-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">شماره زینک:</label>
                                                <?= $model->zink_number ?>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">تعداد زینک:</label>
                                                <?= $model->zink_count ?>
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>

                                </table>
                            </div>

                            <!-- Table -->

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">اطلاعات ثبت</div>
                            <div class="panel-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">کاربر ثبت کننده:</label>
                                                <?php
                                                if (!empty($model->uid)){
                                                    $user= \common\models\User::findOne(['id'=>$model->uid]);
                                                    if (!empty($user)){
                                                        if (!empty($user->fullname)){
                                                            echo $user->fullname;
                                                        }else{
                                                            echo $user->username;
                                                        }
                                                    }
                                                }

                                                ?>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">تاریخ ثبت:</label>
                                                <?= (new amintado\base\AmintadoFunctions())->convertdatetime($model->date) ?>
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>

                                </table>
                            </div>

                            <!-- Table -->

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'factor_num')->textInput(['maxlength' => true, 'placeholder' => 'شماره فاکتور را وارد کنید...']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'litography')->widget(Select2::className(),
                [
                        'data'=>ArrayHelper::map(Litography::find()->all(),'name','name')
                ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->widget(CKEditor::className()) ?>


    <div class="form-group">
        <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
            <?= Html::submitButton($model->isNewRecord ? 'ثبت' : 'بروزرسانی', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if (Yii::$app->controller->action->id != 'index'): ?>
            <?= Html::submitButton('ایجاد یک کپی', ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
        <?php endif; ?>
        <?= Html::a('لغو و بستن فرم', '#', ['class' => 'btn btn-danger', 'id' => 'cancel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
