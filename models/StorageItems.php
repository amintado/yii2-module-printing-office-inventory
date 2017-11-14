<?php

namespace amintado\pinventory\models;

use Yii;

/**
 * This is the base model class for table "{{%storage_items}}".
 *
 * @property integer $id
 * @property string $storage
 * @property string $product
 * @property float $stock
 * @property float $min_indicator
 * @property float $max_indicator
 *
 * @property \amintado\pinventory\models\Storage $storage0
 */
class StorageItems extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'storage0'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stock','min_indicator','max_indicator'], 'number'],
            [['storage', 'product'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%storage_items}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('atpinventory', 'ID'),
            'storage' => Yii::t('atpinventory', 'Storage'),
            'product' => Yii::t('atpinventory', 'Product'),
            'stock' => Yii::t('atpinventory', 'Stock'),
            'min_indicator' => Yii::t('atpinventory', 'min_indicator'),
            'max_indicator' => Yii::t('atpinventory', 'max_indicator'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStorage0()
    {
        return $this->hasOne(\amintado\pinventory\models\Storage::className(), ['name' => 'storage']);
    }
    

    /**
     * @inheritdoc
     * @return \amintado\wordpress\models\StorageItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \amintado\wordpress\models\StorageItemsQuery(get_called_class());
    }
}
