<?php

namespace app\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "catalog_price".
 *
 * @property integer $id
 * @property integer $type
 * @property double $old_value
 * @property double $value
 * @property integer $object_id
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const TYPE_DEFAULT = 1;
    const TYPE_OPT = 2;
    const TYPE_VIP = 3;

    public static function tableName()
    {
        return 'catalog_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'object_id'], 'integer'],
            [['old_value', 'value'], 'number'],
            [['object_id'], 'required'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('catalog', 'ID'),
            'type' => Yii::t('catalog', 'Type'),
            'old_value' => Yii::t('catalog', 'Old Value'),
            'value' => Yii::t('catalog', 'Value'),
            'object_id' => Yii::t('catalog', 'Object ID'),
        ];
    }
}
