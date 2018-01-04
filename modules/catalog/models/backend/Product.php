<?php

namespace app\modules\catalog\models\backend;

use app\components\files\models\FilesProduct;
use app\modules\attribute\behaviors\MarkBehavior;
use app\modules\property\models\HandlerValue;
use app\modules\property\models\Value;
use Yii;
use app\modules\property\behaviors\PropertyBehavior;
use app\modules\catalog\models\Product as BaseProduct;
use yii\behaviors\SluggableBehavior;

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
class Product extends BaseProduct
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['content'], 'string'],
            [['create_at', 'update_at', 'parent_id', 'category_id'], 'integer'],
            [['name', 'title', 'slug', 'description'], 'string', 'max' => 255],
            [['category_ids'], 'each', 'rule' => ['integer']],
            [['property_ids', 'attr_mark'], 'each', 'rule' => ['integer']],
            [['name' , 'price', 'slug' , 'category_id'], 'required'],
            ['files' , 'safe'],


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




}
