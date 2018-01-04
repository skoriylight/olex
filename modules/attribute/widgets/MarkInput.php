<?php

namespace app\modules\attribute\widgets;

use yii\widgets\InputWidget;
use yii\helpers\Html;
Class MarkInput extends InputWidget{

    public function run()
    {

        $str = '';
        $this->field->label(false);

        $str.= Html::activeCheckbox($this->model, "{$this->attribute}[is_sale]", ['label' => 'Скидки']);
        $str.= '<div class="clear"></div>';
        $str.= Html::activeCheckbox($this->model, "{$this->attribute}[is_new]", ['label' => 'Новинки']);
        $str.= '<div class="clear"></div>';
        $str.= Html::activeCheckbox($this->model, "{$this->attribute}[is_hit]", ['label' => 'Хит']);
        $str.= '<div class="clear"></div>';
        $str.= Html::activeCheckbox($this->model, "{$this->attribute}[is_coming]", ['label' => 'Приходуется']);
        $str.= '<div class="clear"></div>';
        $str.= Html::activeCheckbox($this->model, "{$this->attribute}[is_stock]", ['label' => 'Акции']);

        return $str;
    }
}