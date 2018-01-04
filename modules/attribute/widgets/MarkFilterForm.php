<?php

namespace app\modules\attribute\widgets;

use app\modules\catalog\forms\frontend\search\ProductSearch;
use app\modules\catalog\models\Product;
use yii\base\Widget;

Class MarkFilterForm extends Widget{

    const MARK_SALE = 'is_sale';
    const MARK_STOCK = 'is_stock';
    const MARK_NEW = 'is_new';
    const MARK_HIT = 'is_hit';
    const MARK_COMING = 'is_coming';
    public $category_id;



    public function run(){

        $model = new ProductSearch();
        $model->load(\Yii::$app->request->queryParams);



        $count = (new \yii\db\Query())
            ->from('catalog_product');

        $count->leftJoin('attribute_mark', ' catalog_product.id = attribute_mark.product_id');
        if(!empty($this->category_id)) {
            $count->leftJoin('catalog_category_entity', 'catalog_category_entity.product_id = catalog_product.id');
            $count->where(['catalog_category_entity.category_id' => $this->category_id]);
        }



        $count = [
            'is_new' => (clone $count)->andWhere(['attribute_mark.is_new' => 1])->count(),
            'is_sale' => (clone $count)->andWhere(['attribute_mark.is_sale' => 1])->count(),
            'is_hit' =>(clone $count)->andWhere(['attribute_mark.is_hit' => 1])->count(),
            'is_coming' => (clone $count)->andWhere(['attribute_mark.is_coming' => 1])->count(),
            'is_stock' => $count->andWhere(['attribute_mark.is_stock' => 1])->count(),
        ];
        return $this->render('mark-filter-form/index', ['model' => $model, 'count' => $count]);

    }
}