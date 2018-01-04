<?php
namespace app\modules\favorite\widgets;


use yii\helpers\Html;
use yii\helpers\Url;
use yii;

class CartTable extends \yii\base\Widget
{
    public $model = NULL;

    public $view = 'favorite-tab';

    public $modelName;

    public function init()
    {
        parent::init();

    }

    public function run()
    {

        $dataProvider = new yii\data\ArrayDataProvider([
            'allModels' => $this->model,
        ]);

        return $this->render('cart-table/'.$this->view,
            [
                'model' => $this->model,
                'dataProvider' => $dataProvider
            ]);
    }
}