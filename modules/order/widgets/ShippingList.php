<?php

namespace app\modules\order\widgets;

use yii\widgets\InputWidget;

Class ShippingList extends InputWidget
{


    public function run()
    {

        return $this->render('shipping-list/index',
            [
                'items' => \Yii::$app->order->shippingList,
                'model' => $this->model,
                'form' => $this->field->form,
                'options' => $this->options
            ]);
    }
}