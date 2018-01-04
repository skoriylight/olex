<?php

namespace app\modules\property\models;

use Yii;

/**
 * This is the model class for table "prop_object_group".
 *
 * @property integer $id
 * @property integer $object_id
 * @property integer $group_id
 */
class ObjectGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prop_object_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'group_id'], 'integer'],
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
            'group_id' => Yii::t('property', 'Group ID'),
        ];
    }
}
