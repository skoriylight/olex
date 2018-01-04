<?php
namespace app\modules\catalog\widgets\frontend;


use app\modules\catalog\models\Category;
use yii\base\Widget;
use yii\helpers\Html;

class CategoryTree extends Widget
{
    public $modelClass;

    public function run()
    {
        $model = \app\modules\catalog\models\frontend\Category::getCategoryTreeWithCount();

        return  $this->render('category-tree/index',['model' => $model]);
    }
}