<?php

namespace app\components\files\models;

use Yii;

/**
 * This is the model class for table "files_product".
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
class FilesProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size', 'order', 'foreign_key_id'], 'integer'],
            //[['foreign_key_id'], 'required'],
            [['path', 'base_url', 'type', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('catalog', 'ID'),
            'path' => Yii::t('catalog', 'Path'),
            'base_url' => Yii::t('catalog', 'Base Url'),
            'type' => Yii::t('catalog', 'Type'),
            'size' => Yii::t('catalog', 'Size'),
            'name' => Yii::t('catalog', 'Name'),
            'order' => Yii::t('catalog', 'Order'),
            'foreign_key_id' => Yii::t('catalog', 'Foreign Key ID'),
        ];
    }
}
