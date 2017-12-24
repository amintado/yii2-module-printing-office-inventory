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
 * This is the base model class for table "{{%storage_peoples}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $telephone
 * @property string $address
 * @property string $economic_code
 * @property string $description
 *
 * @property \amintado\pinventory\models\PeoplesCategoryList[] $storagePeoplesCategoriesLists
 */
class Peoples extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'storagePeoplesCategoriesLists'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['name', 'telephone', 'address'], 'string', 'max' => 255],
            [['economic_code'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%storage_peoples}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'نام مرکز',
            'telephone' => 'تلفن',
            'address' => 'آدرس',
            'economic_code' => 'کد اقتصادی',
            'description' => 'توضیحات',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoragePeoplesCategoriesLists()
    {
        return $this->hasMany(\amintado\pinventory\models\PeoplesCategoryList::className(), ['people' => 'id']);
    }
    }
