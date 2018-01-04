<?php

namespace app\modules\catalog\behaviors;


use app\modules\catalog\models\Category;
use app\modules\catalog\models\Price;
use app\modules\catalog\models\Tree;
use app\modules\property\models\Object;
use yii\db\ActiveRecord;
use yii\base\Behavior;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class PriceBehavior extends Behavior
{

    public $attr = ['price_default', 'price_default_old', 'price_opt', 'price_opt_old', 'price_vip', 'price_vip_old'];
    private $_values = null;
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',

        ];
    }

    public function afterDelete(){
        foreach($this->owner->values as $val) {
            $val->delete();
        }
    }



    public function beforeValidate()
    {
        $this->getValues();
        foreach($this->values as $val){
            if(!$val->validate()){

                return false;

            }
        }


    }

    public function afterSave(){
        foreach($this->values as $val){
            $val->object_id = $this->owner->id;
            $val->save();
        }
    }

    public function getPrice_default()
    {

        return $this->values[1]->value;
    }

    public function getPrice_default_old()
    {
        return $this->values[1]->old_value;
    }

    public function getPrice_opt()
    {
        return $this->values[2]->value;
    }

    public function getPrice_opt_old()
    {
        return $this->values[2]->old_value;
    }

    public function getPrice_vip()
    {
        return $this->values[3]->value;
    }

    public function getPrice_vip_old()
    {
        return $this->values[3]->old_value;
    }

    public function setPrice_default($val)
    {

        $some = print_r( $this->values, true ).'<hr>';
        //throw new HttpException(404 ,$some);
        $this->_values[1]->value = $val;
    }

    public function setPrice_default_old($val)
    {
        $this->_values[1]->old_value = $val;
    }

    public function setPrice_opt($val)
    {
        $this->_values[2]->value = $val;
    }

    public function setPrice_opt_old($val)
    {
        $this->_values[2]->old_value = $val;
    }

    public function setPrice_vip($val)
    {
        $this->_values[3]->value = $val;
    }

    public function setPrice_vip_old($val)
    {
        $this->_values[3]->old_value = $val;
    }

    public function getValues()
    {


        if(!is_null($this->_values)) {

            return $this->_values;
        }
        $this->_values = [];

        $models = $this->owner->prices;

        for ($i = 1; $i <= 3; $i++) {
            if (isset($models[$i])) {
                $this->_values[$i] = $models[$i];
            } else {
                $this->_values[$i] = new Price();

                $this->_values[$i]->type = $i;
            }
        }
        return $this->_values;
    }





}