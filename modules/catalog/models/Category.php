<?php

namespace app\modules\catalog\models;


use app\components\files\models\FilesCategory;
use app\modules\main\behaviors\SaveTranslateBehavior;
use app\modules\main\behaviors\TranslateBehavior;
use app\modules\catalog\components\AdjacencyListBehavior;
use mongosoft\file\UploadBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\Query;


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
class Category extends \yii\db\ActiveRecord
{


    public $translate_t;
    public $icon;
    public $img;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_category';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['position', 'parent_id', 'depth'], 'integer'],
            [['name', 'title', 'description', 'slug'], 'string', 'max' => 255],

            [['name', 'slug'], 'required'],
            [['translate_t'], 'safe'],
            ['slug', 'unique'],

            [['img', 'icon'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true],
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
                'attributes_translate' => ['name', 'title', 'description', 'content']

            ],

            [
                'class' => AdjacencyListBehavior::className(),
                'sortable' => [
                    'sortAttribute' => 'position'
                ],

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

    public function getUploadedImgs()
    {
        return $this->hasOne(self::className(), ['id' => 'id']);
    }

    public function getUploadedIcons()
    {
        return $this->hasOne(self::className(), ['id' => 'id']);
    }

    public function getImgUrl()
    {
        $url = $this->img_folder . '/' . $this->img_path;
        return is_file(\Yii::getAlias('@webroot') . $url) ? $url : \Yii::$app->params['noimage'];
    }

    public function getIconUrl()
    {
        $url = $this->icon_folder . '/' . $this->icon_path;
        return is_file(\Yii::getAlias('@webroot') . $url) ? $url : \Yii::$app->params['noimage'];
    }


    public function getProduct()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])
            ->viaTable('{{%catalog_category_entity}}', ['category_id' => 'id']);
    }

    public static function getCategoryTreeWithCount()
    {
        return self::find()->select(['catalog_category.*'])
            ->with(['children' => function ($q) {
                $q->with(['children' => function ($q) {
                    $q->with(['attributes_t']);
                }, 'attributes_t']);
            },
                'attributes_t'])
            ->andWhere(['catalog_category.parent_id' => null])
            ->all();
    }

    public function getProduct_count()
    {
        return \yii::$app->shop->getProductCount($this->id);

    }

    public function getProductCountRel()
    {
        return $this->hasMany(ProductClean::className(), ['id' => 'product_id'])
            ->viaTable('{{%catalog_category_entity%}}', ['category_id' => 'id']);
    }

    public function getAttrCountRel()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])
            ->viaTable('{{%catalog_category_entity%}}', ['category_id' => 'id']);
    }


    public function getCategoryimg()
    {
        return $this->hasOne(self::className(), ['id' => 'id']);
    }


}
