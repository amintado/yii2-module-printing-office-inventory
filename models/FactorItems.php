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
 * This is the base model class for table "{{%storage_factor_items}}".
 *
 * @property integer $id
 * @property string $product
 * @property string $price
 * @property string $tax
 * @property string $discount
 * @property double $total
 * @property integer $factor
 *
 * @property \amintado\pinventory\models\StorageFactorHead $factor0
 * @property \amintado\pinventory\models\StorageProduct $product0
 */
class FactorItems extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'factor0',
            'product0'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'tax', 'discount', 'total'], 'number'],
            [['price','total'],'required'],
            [['factor'], 'integer'],
            [['product'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%storage_factor_items}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product' => 'کالا',
            'price' => 'قیمت',
            'tax' => 'مالیات',
            'discount' => 'تخفیف',
            'total' => 'تعداد',
            'factor' => 'فاکتور',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFactor0()
    {
        return $this->hasOne(\amintado\pinventory\models\Factor::className(), ['id' => 'factor']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct0()
    {
        return $this->hasOne(\amintado\pinventory\models\Product::className(), ['name' => 'product']);
    }
    }
