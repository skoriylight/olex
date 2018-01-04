<?php

namespace app\modules\catalog\models;

use app\components\files\models\FilesProduct;
use app\modules\attribute\behaviors\MarkBehavior;
use app\modules\attribute\models\Mark;
use app\modules\favorite\models\FavoriteElement;
use app\modules\goods\models\Goods;
use app\modules\property\models\Value;
use edofre\sliderpro\models\Slide;
use edofre\sliderpro\models\slides\Image;
use Yii;
use app\modules\property\behaviors\PropertyBehavior;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "catalog_product".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property double $price
 * @property string $slug
 * @property string $description
 * @property string $content
 * @property integer $order
 * @property integer $create_at
 * @property integer $update_at
 */
class Product extends \yii\db\ActiveRecord
{

    const NO_IMAGE_PATH = '/images/no-image.png';

    //public $category_ids = [];

    public $files;
    private $first_goods;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['content'], 'string'],
            [['create_at', 'update_at', 'parent_id'], 'integer'],
            [['name', 'title', 'slug', 'description'], 'string', 'max' => 255],
            [['category_ids'], 'each', 'rule' => ['integer']],
            [['files', 'attr_mark'], 'safe'],
            [['property_ids', 'attr_mark'], 'each', 'rule' => ['integer']],
        ];
    }

    public function  getMarks(){
        return $this->hasOne(Mark::className(), ['product_id' => 'id']);
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
            'price' => Yii::t('property', 'Price'),
            'slug' => Yii::t('property', 'Slug'),
            'description' => Yii::t('property', 'Description'),
            'content' => Yii::t('property', 'Content'),
            'order' => Yii::t('property', 'Order'),
            'create_at' => Yii::t('property', 'Create At'),
            'update_at' => Yii::t('property', 'Update At'),
        ];
    }


    public function behaviors()
    {
        return [

            'property' => [
                'class' => PropertyBehavior::className(),
                'modelName' => get_class()

            ],
            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'category_ids' => 'categories',
                    'property_ids' => 'values'
                ],
            ],


            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'ensureUnique' => true,
                // 'slugAttribute' => 'slug',
            ],
            [
                'class' => MarkBehavior::className(),

            ],

            'file' => [
                'class' => \trntv\filekit\behaviors\UploadBehavior::className(),
                'filesStorage' => 'fileStorage', // my custom fileStorage from configuration(for properly remove the file from disk)
                'multiple' => true,
                'attribute' => 'files',
                'uploadRelation' => 'uploadedFiles',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
                'orderAttribute' => 'order',
                'uploadModel' => FilesProduct::className()
            ],

        ];
    }



    public function getPrice()
    {
        if (isset($this->goods[0])) {
            return $this->goods[0]->price;
        } else {
            return \Yii::$app->formatter->asDecimal(0, 2);
        }
    }

    public function getOld_price()
    {
        if (isset($this->goods[0])) {
            return $this->goods[0]->old_price;
        } else {
            return \Yii::$app->formatter->asDecimal(0, 2);
        }

    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('{{%catalog_category_entity%}}', ['product_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }


    public function getUploadedFiles()
    {
        return $this->hasMany(FilesProduct::className(), ['foreign_key_id' => 'id'])->orderBy('order');
    }

    public static function categoryListAll($keyField = 'id', $valueField = 'name', $asArray = true)
    {
        $query = Category::find();
        if ($asArray) {
            $query->select([$keyField, $valueField])->asArray();
        }

        return ArrayHelper::map($query->all(), $keyField, $valueField);
    }

    public function getCategoryTreeChecked()
    {

    }

    public function getImages()
    {
        $images = [];

        foreach ($this->uploadedFiles as $one) {

            if(is_file(trim(\Yii::getAlias('@webroot').$one->base_url . '/' . $one->path))) {
                $images[] = $one->base_url . '/' . $one->path;
            }
            

        }

        return $images;
    }

    public function getFirstImage()
    {

        return isset($this->images[0]) ? $this->images[0] : self::NO_IMAGE_PATH;
    }

    public function getSecondImage()
    {
        return isset($this->images[1]) ? $this->images[1] : $this->firstImage;
    }

    public function getGoods()
    {
        return $this->hasMany(Goods::className(), ['product_id' => 'id']);
    }

    public function getGood(){
        return isset($this->goods[0])?$this->goods[0]:$this->first_goods;
    }

    /*public function afterFind()
    {

        if(!$this->goods){
            $goods = new Goods();
            $goods->product_id = $this->id;
            $goods->name = 'default';
            $goods->save();
            $this->first_goods = $goods;
        }
        parent::afterFind();
    }*/

    public function getMark()
    {
        return $this->hasOne(Mark::className(), ['product_id' => 'id']);
    }

    public function getSliderImages($thumb = false)
    {
        $slides = [];


        foreach ($this->getImages() as $img) {
            if (!$thumb) {
                $slides[] = new Slide([
                    'items' => [
                        new Image(['src' => \Yii::$app->imageresize->getUrl(trim($img, '/'), 500, 500)]),
                    ],
                ]);
            } else {
                $slides[] = new \edofre\sliderpro\models\Thumbnail(
                    ['tag' => 'img',
                        'htmlOptions' => ['src' => \Yii::$app->imageresize->getUrl(trim($img, '/'), 100, 100)]
                    ]);
            }
        }

        return $slides;


    }


}
