<?php

namespace app\modules\catalog\widgets\backend;

use app\modules\catalog\models\backend\Product;
use yii\helpers\ArrayHelper;

Class CategoryTreeCheck extends \yii\base\Widget
{

    public $model_id = null;


    public function init()
    {
        \app\modules\catalog\widgets\backend\assets\category_tree_check\WidgetAsset::register($this->getView());
        parent::init();
    }

    public function run()
    {
        if(is_integer($this->model_id) ) {
            $model = Product::find()->with('categories')->where(['id' => $this->model_id])->one();
        } else {
            $model = new Product();
        }

        $categoryList = ArrayHelper::map($model->categories, 'id' , 'name');
        return $this->render('category-tree-check/index', ['id' => $this->model_id, 'model' => $model, 'categoryList' => $categoryList]);
    }
}

