<?php

namespace app\modules\favorite\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

Class BtnDelete extends Widget{

    public $model;
    public $tag = 'a';
    public $class = 'cart-delete-el';


    public $icon = '<img src="/images/delete-ico.png" alt="">';

    public function init()
    {
        \app\modules\favorite\widgets\assets\WidgetAsset::register($this->getView());
    }

    public function run(){

        return Html::tag($this->tag, !is_null($this->icon)?$this->icon:'',
            [
                'class' => $this->class,
                'data-role' => 'favorite-delete-btn',
                'data-url' => Url::to(['/favorite/default/delete']),
                'data-id' => $this->model->id,
                'data-model' => $this->model->model
            ]);
    }

}