<?php

namespace amintado\pinventory\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "{{%storage_print}}".
 *
 * @property integer $id
 * @property string $storage
 * @property string $product
 * @property string $zink_number
 * @property double $tiraj
 * @property integer $frame_count
 * @property integer $zink_count
 * @property string $Dimensions
 * @property integer $one_two
 * @property double $color_count
 * @property string $five_color
 * @property double $page_count
 * @property string $date
 * @property integer $uid
 * @property string $description
 */
class Sprint extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


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
            [['id', 'frame_count', 'zink_count', 'one_two', 'uid'], 'integer'],
            [['frame_count', 'zink_count', 'one_two', 'uid'], 'required'],
            [['tiraj', 'color_count', 'page_count'], 'number'],
            [['date'], 'safe'],
            [['description'], 'string'],
            [['storage', 'product', 'zink_number', 'Dimensions', 'five_color'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%storage_print}}';
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
            'zink_number' => Yii::t('atpinventory', 'Zink Number'),
            'tiraj' => Yii::t('atpinventory', 'Tiraj'),
            'frame_count' => Yii::t('atpinventory', 'Frame Count'),
            'zink_count' => Yii::t('atpinventory', 'Zink Count'),
            'Dimensions' => Yii::t('atpinventory', 'Dimensions'),
            'one_two' => Yii::t('atpinventory', 'One Two'),
            'color_count' => Yii::t('atpinventory', 'Color Count'),
            'five_color' => Yii::t('atpinventory', 'Five Color'),
            'page_count' => Yii::t('atpinventory', 'Page Count'),
            'date' => Yii::t('atpinventory', 'Date'),
            'uid' => Yii::t('atpinventory', 'Uid'),
            'description' => Yii::t('atpinventory', 'Description'),
        ];
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'uid',
                'updatedByAttribute' => false,
            ]
        ];
    }


}
