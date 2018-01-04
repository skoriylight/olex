<?php

namespace app\modules\main\models;

use Yii;

/**
 * This is the model class for table "main_translate".
 *
 * @property integer $id
 * @property string $language_id
 * @property string $class_name
 * @property string $attribute
 * @property string $message
 * @property integer $model_id
 */
class Translate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_translate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['model_id'], 'integer'],
            [['language_id', 'class_name', 'attribute'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'language_id' => Yii::t('main', 'Language ID'),
            'class_name' => Yii::t('main', 'Class Name'),
            'attribute' => Yii::t('main', 'Attribute'),
            'message' => Yii::t('main', 'Message'),
            'model_id' => Yii::t('main', 'Model ID'),
        ];
    }
}
