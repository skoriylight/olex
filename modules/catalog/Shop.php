<?php

namespace app\modules\catalog;

use app\modules\catalog\forms\frontend\search\ProductSearch;
use app\modules\catalog\models\Category;
use app\modules\catalog\models\Price;
use app\modules\catalog\models\Product;
use yii\db\Expression;

class Shop extends \yii\base\Component
{
    public $data;
    public $productModel = Product::class;
    public $productSearchModel = ProductSearch::class;
    public $priceType = Price::TYPE_DEFAULT;
    protected $q;
    protected $_categories_count = null;

    public function getCategories()
    {

    }

    public function getCategoriesProductCount()
    {
        if (is_null($this->_categories_count)) {
            $this->_categories_count = (new \yii\db\Query())
                ->select(['category_id', 'COUNT(DISTINCT product_id) as count'])
                ->from('{{%catalog_category_entity%}} as cat')
                ->groupBy('cat.category_id')
                ->indexBy('category_id')
                ->all();
        }
        return $this->_categories_count;
    }


    public function getProductCount($cat_id)
    {
        return isset($this->categoriesProductCount[$cat_id]) ? $this->categoriesProductCount[$cat_id]['count'] : 0;
    }


    public function getProducts($category_id = null)
    {


        $this->q = call_user_func([$this->productModel, 'find']);
        $this->q = Product::find();

        $exists = (new \yii\db\Query())
            ->select(new Expression(1))
            ->from('catalog_category_entity')
            ->where('`catalog_category_entity`.`product_id` = `catalog_product`.`id`');
        if (!is_null($category_id)) {

            $exists->andWhere(['catalog_category_entity.category_id' => $category_id]);
        } else {
            $exists->andWhere(['IS NOT', 'catalog_category_entity.category_id', null]);

        }
        $this->q->where(['exists', $exists]);
        $this->setPrice();

        return $this;

    }

    public function getQuery()
    {
        $this->q->with(['uploadedFiles', 'goods', 'goods.prices']);
        return $this->q;
    }

    public function joinParams($modelName)
    {
        $params = new $modelName;
        $params->load(\Yii::$app->request->queryParams);
        foreach ($params->filterValue as $prop) {
            $condStr = 'IN (';
            foreach ($prop as $val) {
                $condStr .= "$val ,";
            }
            $condStr = trim($condStr, ',') . ')';
            $this->q->andWhere(
                "EXISTS(SELECT 1 FROM prop_handler_value LEFT JOIN prop_value ON prop_handler_value.value_id = prop_value.id WHERE catalog_product.id = prop_handler_value.handler_id AND prop_value.id " . $condStr . ')');
        }
        return $this;
    }


    protected function setPrice()
    {
        if (!empty($min = \Yii::$app->request->get('min-price')) && !empty($max = \Yii::$app->request->get('max-price'))) {
            $this->q->andWhere(
                "EXISTS(SELECT catalog_price.value, catalog_price.object_id, goods.product_id, goods.id FROM goods 
                LEFT JOIN catalog_price ON catalog_price.object_id = goods.id
                WHERE goods.product_id = catalog_product.id
                AND catalog_price.value >= $min
                AND catalog_price.value <= $max
                AND catalog_price.type = $this->priceType)"
            );

        }
        return $this;
    }

    public function setAttributes(array $attributes = ['is_new', 'is_sale', 'is_hit', 'is_coming', 'is_stock'])
    {
        $model = new $this->productSearchModel();
        $model->load(\Yii::$app->request->queryParams);
        $this->q->leftJoin('{{%attribute_mark%}}', '{{%attribute_mark%}}.product_id = {{%catalog_product%}}.id');
        foreach ($attributes as $attr) {
            $this->addAttrQuery($model, $attr);
        }
        return $this;
    }

    protected function addAttrQuery($model, $attr)
    {
        if (!empty($model->attr_mark[$attr])) {
            $this->q->andWhere(["attribute_mark.{$attr}" => 1]);
        }
        return $this;
    }


}