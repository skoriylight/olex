<?php

namespace app\modules\catalog\widgets\frontend;

use app\modules\catalog\forms\frontend\search\ValueFilterSearch;
use app\modules\catalog\models\Category;
use app\modules\main\components\Tr;
use app\modules\property\models\Object;
use kartik\checkbox\CheckboxX;
use kartik\field\FieldRange;
use sjaakp\bandoneon\Bandoneon;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use bookin\aws\checkbox\AwesomeCheckbox;
use tejrajs\collapsewidget\CollapseWidget;
use kartik\slider\Slider;


class ConsumablesForm extends Widget
{
    public $category_id = null;


    public function run()
    {


        $model = Object::find()->joinWith('groups')->where(['prop_group.alias' => 'brands'])->with('values')->all();
        echo count($model);

        $arr = [];
        foreach ($model as $one) {



            if(!is_null($categories = self::getCategories($one->id))) {
                foreach ($categories as $cat) {
                    $arr[$one->id]['label'] = $one->name;
                    $valuesList = [];
                    foreach ($one->values as $val) {
                        $valuesList["ValueFilterSearch[filterValue][$one->id][$val->id]"] = $val->id;
                    }
                    $params = ArrayHelper::merge(['/catalog'],$valuesList, ['category_slug' => $cat->slug]);
                    $arr[$one->id]['items'][$cat->id] =
                        [
                            'url' => Url::toRoute($params),
                            'label' => $cat->name,
                            'image' => $cat->imgUrl
                        ];
                }
            }

        }


    return \app\modules\catalog\widgets\frontend\MenuBlock::widget([
        'title' => Tr::t('main', 'CONSUMABLES'),
        'items' => $arr
    ]);


    }
    protected static function getCategories($property_id){

        $exists = "EXISTS(SELECT 1 FROM catalog_product LEFT JOIN prop_handler_value 
        LEFT JOIN prop_value ON prop_value.id = prop_handler_value.value_id
        ON catalog_product.id = prop_handler_value.handler_id
        WHERE prop_value.object_id = $property_id AND catalog_category.id = catalog_product.category_id)";


        return Category::find()->where($exists)
            ->all();
    }
}