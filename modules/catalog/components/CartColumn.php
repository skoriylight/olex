<?php

namespace app\modules\catalog\components;

use yii\helpers\Html;

Class CartColumn extends \yii\grid\DataColumn
{

    protected function renderDataCellContent($model, $key, $index)
    {
        $key_id = $this->grid->keyMap[$model->id];
        return Html::tag('div', parent::renderDataCellContent($model, $key, $index),
            [
                'class' => "cart-collapse cart-block-{$key_id} in",
            ]);
    }
}