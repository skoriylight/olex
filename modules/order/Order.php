<?php

namespace app\modules\order;

use app\modules\favorite\models\FavoriteElement;
use app\modules\order\models\OrderElement;
use app\modules\order\models\OrderShippingType;
use yii;

class Order extends \yii\base\Component
{
    private $_elements = null;
    private $_count = null;
    private $_order = null;



    public function init()
    {
        //$this->update();
    }

    public function put($element, $count)
    {

        $model = new OrderElement();
        $model->item_id = $element->id;
        $model->price = $element->price;
        $model->count = $count;

        $model->model = $element->model;

        $this->_elements[] = $model;
    }

    public function getOrder(){
        if($this->_order === null) {
            return $this->_order =new \app\modules\order\models\Order();
        }
        return $this->_order;
    }

    public function save($data = []){
        $order = new \app\modules\order\models\Order();
        $order->load($data);
        if(\Yii::$app->user->isGuest) {
            $order->user_id = null;
        } else {
            $order->user_id = yii::$app->user->id;
        }
        $this->_order = $order;
        $order->email = \Yii::$app->user->identity->email;
        $order->timestamp = time();
        $order->cost = $this->getCost();
        $order->validate();

        if($order->save()) {

            foreach ($this->_elements as $el) {
                $el->order_id = $order->id;
                $el->save();
            }
            return true;
        }
        return false;

    }



    public function getShippingList(){
       $model =  OrderShippingType::find()->select(['name', 'id'])->asArray()->all();
       return yii\helpers\ArrayHelper::map($model, 'id', 'name');
    }

    public function getElements()
    {
        if (is_null($this->_elements)) {
            $this->update();
        }
        return $this->_elements;
    }

    public function getCost(){
        $cost = 0;
        foreach ($this->elements as $el){
            $cost+= (float) $el->price;
        }
        return $cost;
    }

    public function getCount()
    {
        if (is_null($this->_count)) {
            $this->update();
        }

        return $this->_count;
    }

    public function getUserOrders(){
        return \app\modules\order\models\Order::find()->where(['user_id' => \Yii::$app->user->id]);
    }




}