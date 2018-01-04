<?php

namespace app\modules\goods\models;

use Yii;

/**
 * This is the model class for table "goods_property".
 *
 * @property integer $id
 * @property integer $goods_id
 * @property integer $property_id
 */
class GoodsProperty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'property_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('goods', 'ID'),
            'goods_id' => Yii::t('goods', 'Goods ID'),
            'property_id' => Yii::t('goods', 'Property ID'),
        ];
    }
}
