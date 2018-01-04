<?php

namespace app\modules\catalog\components;

use yii\grid\ActionColumn;
use yii\helpers\Html;

Class CartActionColumn extends ActionColumn{

    protected function renderDataCellContent($model, $key, $index)
    {
        $columnContent = preg_replace_callback('/\\{([\w\-\/]+)\\}/', function ($matches) use ($model, $key, $index) {
            $name = $matches[1];

            if (isset($this->visibleButtons[$name])) {
                $isVisible = $this->visibleButtons[$name] instanceof \Closure
                    ? call_user_func($this->visibleButtons[$name], $model, $key, $index)
                    : $this->visibleButtons[$name];
            } else {
                $isVisible = true;
            }

            if ($isVisible && isset($this->buttons[$name])) {
                $url = $this->createUrl($name, $model, $key, $index);
                return call_user_func($this->buttons[$name], $url, $model, $key);
            } else {
                return '';
            }
        }, $this->template);

        $key_id = $this->grid->keyMap[$model->id];
        return Html::tag('div', $columnContent,
            [
                'class' => "cart-collapse cart-block-{$key_id} in",
            ]);
    }

}