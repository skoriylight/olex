<?php

namespace app\modules\property\behaviors;


use app\modules\property\models\HandlerValue;
use app\modules\property\models\Object;
use app\modules\property\models\Value;
use yii\db\ActiveRecord;
use yii\base\Behavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class PropertyBehavior extends Behavior
{
    public $modelName = Null;



    public function attach($owner)
    {
        parent::attach($owner); // TODO: Change the autogenerated stub
        if(is_null($this->modelName)){
            $this->modelName = get_class($owner);
        }
    }



    public function getPropValues()
    {

        return $this->owner->hasMany(Value::className(), ['id' => 'value_id'])
            ->viaTable('{{%prop_handler_value%}}', ['handler_id' => 'id'])
            ->joinWith('property')
            ->where(['{{%prop_object%}}.class' => $this->modelName]);
    }

    public function getFilterValues(){


        $val = new Value();
        return $val->getFilterValuesInModel($this->modelName);
    }

    public function getPropValuesArr(){
        $arr = [];
        foreach($this->owner->propValues as $val) {
                $arr[$val->property->id]['values'][$val->id] = $val->name;
                $arr[$val->property->id]['name'] = $val->property->name;
                $arr[$val->property->id]['id'] = $val->property->id;

        }
        return $arr;
    }

    public function getPropertyForClass($class = null){
        if(is_null($class)) {
            $class = get_class($this->owner);
        }

        return Value::find()->where(['{{%prop_object%}}.class' => $class])->joinWith('property')->all();

    }

    public function getHandlerValues(){
        $this->owner->hasMany(HandlerValue::className(), ['handler_id' => 'id']);
    }

    public function getValues(){
        return $this->owner->hasMany(Value::className(), ['id' => 'value_id'])
            ->viaTable('prop_handler_value', ['handler_id' => 'id']);
    }

    public function getHandlerValuesArrIndexByObject(){
        $model = $this->owner->handlerValues;
        $res = [];
        foreach ($model as $val) {
            $res[$val->object_id][] = $val->id;
        }

        return $res;
    }

    public function gruopValueForProperty($class = null){
        $model = $this->getPropertyForClass($class);
        $res = [];
        foreach ($model as $val) {
            $res[$val->property->id]['property'] = $val->property->name;
            $res[$val->property->id]['items'][$val->id] = $val->name;
        }

        return $res;

    }



    public function beforeValidate($event)
    {
        // ...
    }
}