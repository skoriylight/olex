<?php
namespace app\modules\catalog\widgets\cart;


use yii\helpers\Html;
use yii\helpers\Url;
use yii;

class CartTable extends \yii\base\Widget
{
    public $model = NULL;

    public $addElementUrl = '/catalog/cart/add-elements';

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $this->model = \yii::$app->cart->cart->getElements()
            ->joinWith('products')
            ->orderBy(['{{%catalog_product%}}.category_id'=> SORT_DESC, '{{%catalog_product%}}.id'=> SORT_DESC])

            ->all();
        \yii::$app->cart->cart->id;
        $dataProvider = new yii\data\ArrayDataProvider([
            'allModels' => $this->model,

        ]);

        return $this->render('cart-table/index',
            [
                'model' => $this->model,
                'url' => Url::toRoute($this->addElementUrl),
                'dataProvider' => $dataProvider
            ]);
    }
}