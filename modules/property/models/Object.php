<?php

namespace app\modules\property\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "prop_object".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $alias
 * @property string $class
 * @property integer $order
 */
class Object extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $values_ids;
    public $handlerClass;
    public $file;

    const GROUP_FILTER = 1;
    const GROUP_BRAND = 2;
    

    public static function tableName()
    {
        return 'prop_object';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'order'], 'integer'],
            [['name', 'alias', 'class', 'file_folder', 'file_path'], 'string', 'max' => 255],
            [['name', 'groups_ids'], 'required'],
            [['groups_ids'], 'each', 'rule' => ['integer']],
            [['file'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true],
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



    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'ensureUnique' => true,
                'slugAttribute' => 'alias',
            ],

            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'values_ids' => 'values',
                    'groups_ids' => 'groups'

                ],
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

    // получить список опций свойства

    public function getValues()
    {
        return $this->hasMany(Value::className(), ['object_id' => 'id']);
    }

    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['id' => 'group_id'])->viaTable('{{%prop_object_group%}}', ['object_id' => 'id']);
    }

    public static function geGroupList() //
    {
        $list = Group::find()->all();
        return ArrayHelper::map($list,'id' ,'name');
    }





    // Список опций свойства ключ - значение

    public function getValuesArr() //
    {
        return ArrayHelper::map($this->values,'id' ,'name');
    }






    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('property', 'ID'),
            'name' => Yii::t('property', 'Name'),
            'type' => Yii::t('property', 'Type'),
            'alias' => Yii::t('property', 'Alias'),
            'class' => Yii::t('property', 'Class'),
            'order' => Yii::t('property', 'Order'),
            'groups_ids' => 'Группы'
        ];
    }
}
