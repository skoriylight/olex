<?php

namespace app\modules\catalog\widgets\frontend;

use app\modules\catalog\forms\frontend\search\ValueFilterSearch;
use app\modules\catalog\models\Price;
use app\modules\goods\models\Goods;
use app\modules\main\components\Tr;
use kartik\checkbox\CheckboxX;
use kartik\field\FieldRange;
use function PHPSTORM_META\type;
use sjaakp\bandoneon\Bandoneon;
use yii\base\Widget;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use bookin\aws\checkbox\AwesomeCheckbox;
use kartik\slider\Slider;


class ProductFilterForm extends Widget
{
    public $category_id = null;


    public function run()
    {
        $model = ValueFilterSearch::getFilterValues($this->category_id);

        $price = (new Query())->select('{{%catalog_price%}}.value')->from('{{%goods%}}')

            ->leftJoin('{{%catalog_price%}}', '{{%catalog_price%}}.object_id = {{%goods%}}.id')
            ->leftJoin('{{%catalog_category_entity%}}', '{{%catalog_category_entity%}}.product_id = {{%goods%}}.product_id')
            ->where(['{{%catalog_price%}}.type' => 1, ])
            ->andWhere(['IS NOT', '{{%catalog_category_entity%}}.product_id', Null])
        ;

        if(!is_null($this->category_id)){

            $price = $price->andWhere(['{{%catalog_category_entity%}}.category_id' => $this->category_id,]);
        }
        $price_min = $price->min('{{%catalog_price%}}.value');
        $price_max = $price->max('{{%catalog_price%}}.value');

        $price_min = (integer) (empty($price_min)?0:$price_min);
        $price_max =  (integer) (empty($price_max)?0:$price_max);

        $arr = [];
        foreach ($model as $one) {
            $one->load(\Yii::$app->request->queryParams);

            $arr[$one->property->id]['name'] = $one->property->name;
            $arr[$one->property->id]['is_open'] = false;
            $arr[$one->property->id]['items'][$one->id] = ['model' => $one, 'label' => $one->name];
            if(!empty($one->filterValue[$one->property->id][$one->id])) {
                $arr[$one->property->id]['is_open'] = true;
            }
        }

        $priceValueMax = (integer) !empty($_GET['max-price'])?$_GET['max-price']:$price_max;
        $priceValueMin = (integer) !empty($_GET['min-price'])?$_GET['min-price']:$price_min;

        return $this->render('product-filter-form/index', [
            'arr' => $arr,
            'price_value' => "$priceValueMin,$priceValueMax",
            'price_max' =>$price_max,
            'price_min' => $price_min,
            'priceValueMin' => $priceValueMin,
            'priceValueMax' => $priceValueMax,
        ]);

    }
}