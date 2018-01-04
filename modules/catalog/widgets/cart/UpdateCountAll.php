<?php

namespace app\modules\catalog\widgets\cart;

use app\modules\main\components\Tr;
use yii\helpers\Html;

Class UpdateCountAll extends \yii\base\Widget
{

    public $model = null;
    public $dataTarget = '';

    public function init()
    {
        \app\modules\catalog\widgets\cart\assets\WidgetAsset::register($this->getView());
    }

    public function run()
    {
        $ret = Html::beginTag('div', ['class' => 'btn btn-touchspin form-touch-min']);
        $ret .= Html::beginTag('table', ['style' => 'margin: 0 auto']);
        $ret .= Html::beginTag('tr');
        $ret .= Html::beginTag('td', ['style' => 'padding-right: 10px']);
        $ret .= Tr::t('catalog-main', 'ALL_FOR');
        $ret .= Html::endTag('td');
        $ret .= Html::beginTag('td');
        $ret .= \kartik\touchspin\TouchSpin::widget([
            'name' => 't1',
            'options' => [
                'class' => 'btn-update-count-all',
                'data-role' => 'cart-update-count-btn',
                'data-target' => $this->dataTarget,

            ],
            'pluginOptions' => [
                'initval' => 1,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'decimals' => 0,
                'buttonup_txt' => '+',
                'buttondown_txt' => '-'

            ],
        ]);
        $ret .= Html::endTag('td');
        $ret .= Html::endTag('tr');
        $ret .= Html::endTag('table');


        $ret .= Html::endTag('div');
        return $ret;
    }

}