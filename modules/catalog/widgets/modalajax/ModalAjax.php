<?php

namespace app\modules\catalog\widgets\modalajax;

use yii\base\Widget;
use yii\helpers\Html;

Class ModalAjax extends Widget{

    public $options;
    public $url = '';
    public function run(){
        return Html::a( '','#',['class' => 'glyphicon glyphicon-eye-open', 'data-role' => 'modalajax', 'data-url' => $this->url] );
    }


    public function init()
    {
        parent::init();
        $view = $this->getView();

        WidgetAsset::register($view);

        return true;
    }
}