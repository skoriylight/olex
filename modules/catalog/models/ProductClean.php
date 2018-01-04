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
class ProductClean extends \yii\db\ActiveRecord
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


        ];
    }





}
