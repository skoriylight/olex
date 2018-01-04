<?php

namespace app\modules\catalog\widgets\cart;

use app\modules\main\components\Tr;
use kuakling\lobibox\LobiboxAsset;
use talma\widgets\NotifyAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii;

class UpdateElements extends \yii\base\Widget
{
    public $model = NULL;

    public $updateElementUrl = '/catalog/cart/info';

    public function init()
    {
        parent::init();
        $view = $this->getView();

        \app\modules\catalog\widgets\cart\assets\WidgetAsset::register($view);
        $this->getView()->registerJS('
        ltcart.cart.updateElementUrl = "' . Url::toRoute($this->updateElementUrl) . '";
       
        '
        );
        return true;
    }

    public function run()
    {

        return '';
    }
}