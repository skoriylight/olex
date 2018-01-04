<?php
namespace app\modules\catalog\widgets\cart;

use kuakling\lobibox\LobiboxAsset;
use talma\widgets\NotifyAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii;

class BuyBtn extends \yii\base\Widget
{
    public $model = NULL;
    public $page = 'index'; //страница на которой он отображается (каталог и карточка товара)
    public $addElementUrl = '/catalog/cart/add-elements';

    public function init()
    {
        \app\modules\catalog\widgets\cart\assets\WidgetAsset::register($this->getView());
    }

    public function run()
    {

        return $this->render('buy-btn/'.$this->page, ['model' => $this->model, 'url' => Url::toRoute($this->addElementUrl)]);
    }
}