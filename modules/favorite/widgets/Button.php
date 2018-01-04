<?php

namespace app\modules\favorite\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

Class Button extends Widget{

    public $model;
    public $tag = 'a';
    public $class = 'btn-favorite';
    public $class_active = 'btn-favorite active';
    public $icon = '<i class="glyphicon glyphicon-heart"></i>';

    public function init()
    {
        \app\modules\favorite\widgets\assets\WidgetAsset::register($this->getView());
    }

    public function run(){

        return Html::tag($this->tag, !is_null($this->icon)?$this->icon:'',
            [
                'class' => $this->class.
                    ($this->model->favorite !== null?' active':''),
                'data-role' => 'favorite-put-btn',
                'data-url' => Url::to(['/favorite/default/put']),
                'data-id' => $this->model->id,
                'data-model' => $this->model->model
            ]);
    }

}