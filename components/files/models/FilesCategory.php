<?php

namespace app\components\files\models;

use Yii;

/**
 * This is the model class for table "files_category".
 *
 * @property integer $id
 * @property string $path
 * @property string $base_url
 * @property string $type
 * @property integer $size
 * @property string $name
 * @property integer $order
 * @property integer $foreign_key_id
 */
class FilesCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size', 'order', 'foreign_key_id'], 'integer'],
            [['foreign_key_id'], 'required'],
            [['path', 'base_url', 'type', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('files', 'ID'),
            'path' => Yii::t('files', 'Path'),
            'base_url' => Yii::t('files', 'Base Url'),
            'type' => Yii::t('files', 'Type'),
            'size' => Yii::t('files', 'Size'),
            'name' => Yii::t('files', 'Name'),
            'order' => Yii::t('files', 'Order'),
            'foreign_key_id' => Yii::t('files', 'Foreign Key ID'),
        ];
    }
}
