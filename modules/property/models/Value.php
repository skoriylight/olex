<?php

namespace app\modules\property\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "prop_value".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $property_id
 * @property integer $order
 */
class Value extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $handlerClass;
    public $file;

    public static function tableName()
    {
        return 'prop_value';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'ensureUnique' => true,
                'slugAttribute' => 'alias',
            ],

            'file' => [
                'class' => \trntv\filekit\behaviors\UploadBehavior::className(),
                'filesStorage' => 'fileStorage', // my custom fileStorage from configuration(for properly remove the file from disk)
                'multiple' => false,
                'attribute' => 'file',
                'uploadRelation' => 'uploadedFiles',
                'pathAttribute' => 'file_path',
                'baseUrlAttribute' => 'file_folder',
                'typeAttribute' => 'type',


                'uploadModel' => self::className()
            ],


        ];
    }

    public function getUploadedFiles()
    {
        return $this->hasOne(self::className(), ['id' => 'id']);
    }

    public function getImgUrl(){
        $url = $this->file_folder.'/'.$this->file_path;
        return  is_file(\Yii::getAlias('@webroot').$url)?$url:\Yii::$app->params['noimage'];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order', 'object_id'], 'integer'],
            [['name', 'alias', 'file_folder', 'file_path'], 'string', 'max' => 255],
            [['name'], 'required'],
            [['file'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true],
        ];
    }



    public function getProperties(){
        return $this->hasMany(Object::className(), ['id' => 'object_id']);
    }

    public function getProperty(){
        return $this->hasOne(Object::className(), ['id' => 'object_id']);
    }






    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('property', 'ID'),
            'name' => Yii::t('property', 'Name'),
            'alias' => Yii::t('property', 'Alias'),
            'object_id' => Yii::t('property', 'Property ID'),
            'order' => Yii::t('property', 'Order'),
        ];
    }
}
