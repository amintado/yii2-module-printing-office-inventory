<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model amintado\pinventory\models\Sprint */

$this->title = 'چاپ شماره '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'نمایش اطلاعات چاپ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sprint-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= 'نمایش اطلاعات چاپ' ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('common', 'PDF'), 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('common', 'Will open the generated PDF file in a new window')
                ]
            )?>
            <?= Html::a(Yii::t('common', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
        <div class="container">
            <?php
            if (!empty($model->factor_num)){
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-info">
                        	  <div class="panel-heading">
                        			<h3 class="panel-title">اطلاعات لیتوگرافی</h3>
                        	  </div>
                        	  <div class="panel-body">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="dk">شماره فاکتور لیتوگرافی:</label>
                                          <?= $model->factor_num ?>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="dk">مرکز لیتوگرافی:</label>
                                          <?= $model->litography ?>
                                      </div>
                                  </div>
                        	  </div>
                        </div>
                    </div>

                </div>
            <?php
            }
            ?>

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
            <div class="row">
                <div class="col-md-10">
                    <div class="panel panel-info">
                    	  <div class="panel-heading">
                    			<h3 class="panel-title">توضیحات</h3>
                    	  </div>
                    	  <div class="panel-body">
                              <div class="col-md-12">
                                  <?= $model->description ?>
                              </div>
                    	  </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
