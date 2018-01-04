<?php

namespace app\modules\catalog\models\backend;


use app\components\files\models\FilesCategory;
use app\modules\main\behaviors\SaveTranslateBehavior;
use app\modules\main\behaviors\TranslateBehavior;
use app\modules\catalog\components\AdjacencyListBehavior;
use mongosoft\file\UploadBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use app\modules\catalog\models\Category as BaseCategory;




/**
 * This is the model class for table "catalog_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $slug
 * @property integer $position
 * @property integer $parent_id
 */
class Category extends BaseCategory
{


    public function rules()
    {
        return [
            [['content'], 'string'],
            [['position', 'parent_id', 'depth'], 'integer'],

            [['name', 'slug'], 'required'],
            [['translate_t'], 'safe'],
            ['slug', 'unique'],

            [['img' , 'icon'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true],
            [['img_folder', 'img_path', 'icon_folder', 'icon_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('property', 'ID'),
            'name' => Yii::t('property', 'Name'),
            'title' => Yii::t('property', 'Title'),
            'description' => Yii::t('property', 'Description'),
            'content' => Yii::t('property', 'Content'),
            'slug' => Yii::t('property', 'Slug'),
            'position' => Yii::t('property', 'Position'),
            'parent_id' => Yii::t('property', 'Parent ID'),
            'image_url' => Yii::t('property', 'category image'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'ensureUnique' => true,
                // 'slugAttribute' => 'slug',
            ],

            [
                'class' => TranslateBehavior::className(),
                'attributes_translate' => ['name','title', 'description', 'content'],
                'languages' => \Yii::$app->urlManager->languages,
                'className' => get_parent_class()

            ],

            [
                'class' => AdjacencyListBehavior::className(),
                'sortable' => [
                    'sortAttribute' => 'position'
                ],

            ],

            [
                'class' => SaveTranslateBehavior::className(),
                'postAttribute' => 'translate_t',
            ],

            'icon' => [
                'class' => \trntv\filekit\behaviors\UploadBehavior::className(),
                'filesStorage' => 'fileStorage', // my custom fileStorage from configuration(for properly remove the file from disk)
                'multiple' => false,
                'attribute' => 'icon',
                'uploadRelation' => 'uploadedIcons',
                'pathAttribute' => 'icon_path',
                'baseUrlAttribute' => 'icon_folder',
                'typeAttribute' => 'type',
                'uploadModel' => self::className()
            ],
            'img' => [
                'class' => \trntv\filekit\behaviors\UploadBehavior::className(),
                'filesStorage' => 'fileStorage', // my custom fileStorage from configuration(for properly remove the file from disk)
                'multiple' => false,
                'attribute' => 'img',
                'uploadRelation' => 'uploadedImgs',
                'pathAttribute' => 'img_path',
                'baseUrlAttribute' => 'img_folder',
                'typeAttribute' => 'type',
                'uploadModel' => self::className()
            ],



        ];
    }




}
