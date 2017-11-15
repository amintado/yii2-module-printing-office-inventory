<?php

namespace amintado\pinventory\models;

use Yii;

/**
 * This is the base model class for table "{{%storage_product}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $descrition
 *
 * @property \amintado\pinventory\models\StorageItems[] $storageItems
 */
class Product extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'storageItems'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descrition'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%storage_product}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('atpinventory', 'ID'),
            'name' => Yii::t('atpinventory', 'Name'),
            'descrition' => Yii::t('atpinventory', 'Description'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStorageItems()
    {
        return $this->hasMany(\amintado\pinventory\models\StorageItems::className(), ['product' => 'name']);
    }
    


}
