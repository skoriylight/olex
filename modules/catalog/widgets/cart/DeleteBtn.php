<?php

namespace app\modules\catalog\widgets\cart;

use app\modules\main\components\Tr;
use kuakling\lobibox\LobiboxAsset;
use talma\widgets\NotifyAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii;

class DeleteBtn extends \yii\base\Widget
{
    public $model = NULL;

    public $deleteElementUrl = '/catalog/cart/delete-element';

    public function init()
    {
        parent::init();
        $view = $this->getView();

        \app\modules\catalog\widgets\cart\assets\WidgetAsset::register($view);
        $this->getView()->registerJS('
        ltcart.cart.deleteElementUrl = "' . Url::toRoute($this->deleteElementUrl) . '"'
        );
        return true;
    }

    public function run()
    {
        /*if (!is_object($this->model) | !$this->model instanceof \dvizh\cart\interfaces\CartElement) {
            return false;
        }*/

        $model = $this->model;
        return Html::a(Html::img('/images/delete-ico.png'),'' ,
            ['class' => 'cart-delete-el', 'data-role' => 'cart-delete-btn', 'data-id' => $model->id]);
    }
}