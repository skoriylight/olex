<?php

namespace app\modules\property\models;

use Yii;

/**
 * This is the model class for table "prop_handler_value".
 *
 * @property integer $id
 * @property integer $object_id
 * @property integer $handler_id
 * @property integer $value_id
 */
class HandlerValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prop_handler_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'handler_id', 'value_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('property', 'ID'),
            'object_id' => Yii::t('property', 'Object ID'),
            'handler_id' => Yii::t('property', 'Handler ID'),
            'value_id' => Yii::t('property', 'Value ID'),
        ];
    }


}
