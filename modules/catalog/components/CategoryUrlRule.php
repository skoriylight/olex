<?php

namespace app\modules\catalog\components;

use app\modules\catalog\models\Category;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\Tree;
use app\modules\catalog\widgets\frontend\ProductView;
use yii\web\UrlRuleInterface;
use yii\base\Object;

class CategoryUrlRule extends Object implements UrlRuleInterface
{

    public function createUrl($manager, $route, $params)
    {
        return false;
        if ($route === 'catalog/view') {
            if (isset($params['product_slug'])) {
                $product = Product::find()->with('category')->one();
                $category =  $product->category;
                $categories = $category->getParents()->all();

                $url = '';
                foreach ($categories as $cat) {
                    //echo $cat->name;
                }
                return '';
                return $params['manufacturer'] . '/' . $params['model'];
            } elseif (isset($params['manufacturer'])) {
              //  return $params['manufacturer'];
            }
        }
        return false;  // данное правило не применимо
    }

    public function parseRequest($manager, $request)
    {


        /*$pathInfo = $request->getPathInfo();
        if (preg_match('%^(catalog)/((\w|-|\/)+)$%', $pathInfo, $matches)) {
            //return ['admin/catalog', []];
            $arr = $end = explode('/',$matches[2]);
            $end = end($end);

                $product = Product::find()->where(['slug' => $end])->one();
                if(!is_null($product)) {
                    return ['catalog/default/product',['product_id' => $product->id]];
                } elseif(!is_null($category = Tree::find()->joinWith('categories')
                    ->where(['catalog_category.slug' => $end])
                    ->one())) {
                    return ['catalog/default/index',['product_id' => $category->id]] ;
                } else {
                    echo $end;
                    return ['main/default/index', []];
                }

            

        }*/
        return false;  // данное правило не применимо
    }
}