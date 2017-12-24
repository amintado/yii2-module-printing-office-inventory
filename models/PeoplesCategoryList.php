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
 * This is the base model class for table "{{%storage_peoples_categories_list}}".
 *
 * @property integer $id
 * @property integer $people
 * @property integer $category
 *
 * @property \amintado\pinventory\models\PeoplesCategory $category0
 * @property \amintado\pinventory\models\Peoples $people0
 */
class PeoplesCategoryList extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'category0',
            'people0'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'people', 'category'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%storage_peoples_categories_list}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'people' => 'نام مرکز',
            'category' => 'نام دسته',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(\amintado\pinventory\models\PeoplesCategory::className(), ['id' => 'category']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople0()
    {
        return $this->hasOne(\amintado\pinventory\models\Peoples::className(), ['id' => 'people']);
    }
    }
