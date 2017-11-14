<?php
/*******************************************************************************
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 ******************************************************************************/

namespace amintado\pinventory\models;

use common\models\User;
use Yii;

/**
 * This is the base model class for table "{{%storage_cardex}}".
 *
 * @property integer $id
 * @property string $date
 * @property string $description
 * @property double $change
 * @property string $module
 * @property string $model
 * @property string $uid
 * @property string $username
 * @property double $stock
 * @property double $product
 * @property double $storage
 */
class Cardex extends \yii\db\ActiveRecord
{
    const MODULE_PRINT='PRINT';
    const MODULE_DELETE_FROM_STORAGE='DELETE';
    const MODULE_ADD_TO_STORAGE='ADD';
    const MODULE_CHANGED='CHANGE';

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            ''
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['change','uid','id'], 'number'],
            [['stock'],'double'],
            [['description', 'module', 'model','username','product','storage'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%storage_cardex}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'آی دی',
            'date' => 'تاریخ',
            'description' => 'توضیحات',
            'change' => 'تغییرات',
            'module' => 'سند',
            'model' => 'سریال',
            'uid' => 'آی دی کاربر',
            'username' => 'کاربر ثبت کننده',
            'stock' => 'موجودی بعد از عملیات',
            'product' => 'کالا',
            'storage' => 'انبار',
        ];
    }
    public function getU(){
        return User::findOne(['id'=>$this->uid]);
    }

    public function getStorage0(){
        return Storage::findOne(['name'=>$this->storage]);
    }

    public function getProduct0(){
        return Product::findOne(['name'=>$this->product]);
    }
}
