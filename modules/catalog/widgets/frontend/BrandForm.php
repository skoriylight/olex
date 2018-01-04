<?php

namespace app\modules\catalog\widgets\frontend;

use app\modules\catalog\forms\frontend\search\ValueFilterSearch;
use app\modules\main\components\Tr;
use app\modules\property\models\Object;
use kartik\checkbox\CheckboxX;
use kartik\field\FieldRange;
use sjaakp\bandoneon\Bandoneon;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use bookin\aws\checkbox\AwesomeCheckbox;
use tejrajs\collapsewidget\CollapseWidget;
use kartik\slider\Slider;


class BrandForm extends Widget
{
    public $category_id = null;


    public function run()
    {
        $model = ValueFilterSearch::getBrandValues($this->category_id);

        $arr = [];
        foreach ($model as $one) {


            $arr[$one->property->id]['label'] = $one->property->name;
            $prop_id = $one->property->id;
            $arr[$one->property->id]['items'][$one->id] =
                [
                    'url' => Url::toRoute(['/catalog', "ValueFilterSearch[filterValue][$prop_id][$one->id]" => $one->id]),
                    'label' => $one->name,
                    'image' => $one->imgUrl

                ];
        }


    return $this->render('brand-form/index', ['model' => $arr]);


    }
}