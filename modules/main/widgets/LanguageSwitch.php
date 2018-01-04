<?php

namespace app\modules\main\widgets;

use yii\bootstrap\Dropdown;
use yii\helpers\Html;

Class LanguageSwitch extends \yii\base\Widget{

    public $languages = ['ru' => 'ru-RU'];

    public function run()
    {
        $items = [];
        $label = 'ru';
        $lang = \Yii::$app->language;
        foreach ($this->languages as $code => $language) {
            $items[] = [
                'label' => $language,
                'url' => array_merge(
                    \Yii::$app->request->get(),
                    ['/'. \Yii::$app->controller->route, 'language' => $code]),
                'options' => ['class' => $language == $lang?'active':'']
            ];
            $label= $language == $lang?$code:$label;
        }


        echo Html::beginTag('div', ['class' => 'btn-group']);
        echo Html::button($label . ' <span class="caret"></span>',
            ['data-toggle'=>"dropdown", 'class'=>"btn btn-success dropdown-toggle"]);
        echo Dropdown::widget([
            'items' => $items,
        ]);
        echo Html::endTag('div');
    }

}