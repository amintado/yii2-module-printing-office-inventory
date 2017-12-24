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

use Yii;

/**
 * This is the base model class for table "{{%storage_factor_head}}".
 *
 * @property integer $id
 * @property string $serial
 * @property string $date
 * @property string $register_time
 * @property integer $uid
 * @property string $company
 * @property string $sum
 * @property integer $status
 * @property string $storage
 * @property string $tax
 * @property string $discount
 * @property string $transportation
 * @property string $description
 * @property string $paymentPrice
 * @property integer $module
 *
 * @property \amintado\pinventory\models\Peoples $company0
 * @property \amintado\pinventory\models\Storage $storage0
 * @property \common\models\User $u
 * @property \amintado\pinventory\models\FactorItems[] $storageFactorItems
 */
class Factor extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'company0',
            'storage0',
            'u',
            'storageFactorItems'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'register_time'], 'safe'],
            [['uid', 'status', 'module'], 'integer'],
            [['sum', 'tax', 'discount', 'transportation', 'paymentPrice'], 'number'],
            [['serial', 'storage', 'description'], 'string', 'max' => 255],
            [['company'], 'string', 'max' => 11],
            [['date','serial','storage','company'],'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%storage_factor_head}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'serial' => 'سریال',
            'date' => 'تاریخ فاکتور',
            'register_time' => 'تاریخ ثبت',
            'uid' => 'کاربر ثبت کننده',
            'company' => 'شرکت',
            'sum' => 'جمع',
            'status' => 'وضعیت پرداخت',
            'storage' => 'انبار',
            'tax' => 'مالیات',
            'discount' => 'تخفیف',
            'transportation' => 'هزینه ی حمل و نقل',
            'description' => 'توضیحات',
            'paymentPrice' => 'مبلغ قابل پرداخت',
            'module' => 'نوع فاکتور',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany0()
    {
        return $this->hasOne(\amintado\pinventory\models\Peoples::className(), ['name' => 'company']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStorage0()
    {
        return $this->hasOne(\amintado\pinventory\models\Storage::className(), ['name' => 'storage']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'uid']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStorageFactorItems()
    {
        return $this->hasMany(\amintado\pinventory\models\FactorItems::className(), ['factor' => 'id']);
    }
    }
