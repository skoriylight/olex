<?php

namespace app\modules\attribute\behaviors;

use app\modules\attribute\models\Mark;
use yii\base\Behavior;
use yii\db\ActiveRecord;


Class MarkBehavior extends Behavior{

    public $relation = 'marks';
    private $_attr;
    public $attr = 'attr_mark';
    private $_target;
    private $test_count  = 0;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',


        ];
    }

    public function getTarget(){
        if(!is_null($this->owner->{$this->relation})){
            $this->_target = $this->owner->{$this->relation};
        } elseif(is_null($this->_target)){
            $this->_target = new Mark();
            $this->_target->is_sale = 0;
            $this->_target->is_new = 0;
            $this->_target->is_hit = 0;
            $this->_target->is_coming = 0;
            $this->_target->is_stock = 0;
        }

        return $this->_target;
    }

    public function getAttr_mark(){

            $target = $this->target;

        if(is_null($this->_attr)) {
            $this->attr_mark = [
                'is_sale' => $target->is_sale,
                'is_new' => $target->is_new,
                'is_hit' => $target->is_hit,
                'is_coming' => $target->is_coming,
                'is_stock' => $target->is_stock,
            ];
        }

        return $this->_attr;
    }


    public function setAttr_mark($val){

        $this->_attr = $val;
    }

    public function setTarget($val){
        $this->_target = $val;
    }



    public function afterSave(){
        $target = $this->target;
        $target->product_id = $this->owner->id;
        $target->is_sale = $this->owner->{$this->attr}['is_sale'];
        $target->is_new = $this->owner->{$this->attr}['is_new'];
        $target->is_hit = $this->owner->{$this->attr}['is_hit'];
        $target->is_coming = $this->owner->{$this->attr}['is_coming'];
        $target->is_stock = $this->owner->{$this->attr}['is_stock'];
        $target->save();
    }


}