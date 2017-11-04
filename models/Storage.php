<?php

namespace amintado\pinventory\models;

use Yii;

/**
 * This is the base model class for table "{{%storage}}".
 *
 * @property string $name
 *
 * @property \amintado\pinventory\models\StorageItems[] $storageItems
 */
class Storage extends \yii\db\ActiveRecord
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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%storage}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('atpinventory', 'Name'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStorageItems()
    {
        return $this->hasMany(\amintado\pinventory\models\StorageItems::className(), ['storage' => 'name']);
    }
    }
