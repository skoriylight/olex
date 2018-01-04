<?php
namespace app\modules\catalog\widgets;


use app\modules\catalog\models\Category;
use yii\base\Widget;
use yii\helpers\Html;

class CategoryTree extends Widget
{
    public $handler;
    public $model;



    public function run()
    {

        return  $this->render('category-tree/index',['model' => $this->model]);
    }
}