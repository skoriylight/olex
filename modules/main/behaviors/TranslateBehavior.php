<?php

namespace app\modules\main\behaviors;

use app\modules\main\models\Translate;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class TranslateBehavior extends Behavior{

    private $_className = null;
    public $attributes_translate = [];
    public $languages = ['ru' => 'ru-RU', 'en' => 'en-EN'];
    public $translateTableClass = 'app\modules\main\models\Translate';
    protected $_attributes_t = [];

    public function getClassName(){

        return $this->_className;
    }

    public function setClassName($value){
        $this->_className = $value;
    }

    public function canGetProperty($name, $checkVars = true)
    {
        return ((preg_match('/^\w+_t$/', $name) || preg_match('/^\w+_[a-z]{2,2}_[A-Z]{2,2}$/',$name)) ? true : parent::canGetProperty($name, $checkVars = true));
    }


    public function __get($name)
    {

        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } elseif (method_exists($this, 'set' . $name)) {
            throw new InvalidCallException('Getting write-only property: ' . get_class($this) . '::' . $name);
        } elseif (preg_match('/^\w+_t$/',$name)) {
            return $this->getAttribute_t($name);
        }
        throw new UnknownPropertyException('Getting unknown property: ' . get_class($this) . '::' . $name);
    }


    public function attach($owner)
    {

        parent::attach($owner);
        if(is_null($this->className)){

            $this->className = get_class($owner);
        }
    }

    // Возвращает все существующие переводы атрибутов модели
    // геттер, для загрузки переводов текущей раскладки

    public function getAttributes_t(){
        return $this->owner->hasMany($this->translateTableClass,['model_id' => 'id'])
            ->where(['class_name' => $this->className, 'language_id' => \Yii::$app->language])->indexBy('attribute');
    }

    // Загружает указанные переводы
    public function loadAttributes_t($language){

        if(!isset($this->_attributes_t[$language])) {
            return $this->_attributes_t[$language] = $this->owner->hasMany($this->translateTableClass,['model_id' => 'id'])
                ->where(['class_name' => $this->className, 'language_id' => $language])->indexBy('attribute')->all();
        } else {
            return $this->_attributes_t[$language];
        }

    }

    protected function getOriginAttributeName($name){

        if(preg_match('/(^.+)_t$/',$name,$attr) && isset($this->owner->{$attr[1]})) {
            return $attr[1];
        } else {
            throw new UnknownPropertyException('Getting unknown property: ' . get_class($this) . '::' . $attr[1]);
        }
    }

    protected function getOriginAttributeValue($name){
        $attr = $this->getOriginAttributeName($name);
        return $this->owner->$attr;
    }

    // Возвращает перевод соответствующего атрибута, или оригинальное значение
    public function getAttribute_t($name , $language = null){
        if(is_null($language)) {
            $val = $this->owner->attributes_t;

        } else {
            $val = $this->owner->loadAttributes_t($language);

        }

        $first_name = $this->getOriginAttributeName($name);

        return !empty($val[$first_name]->message)?
            $val[$first_name]->message:
            $this->getOriginAttributeValue($name);
    }



    public function getAllAttributes_t(){
        return $this->owner->hasMany($this->translateTableClass,['model_id' => 'id'])
            ->where(['class_name' => $this->className])->indexBy('attribute');
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',


        ];
    }

    public function beforeDelete(){
        $class = $this->translateTableClass;
        $class::deleteAll(['model_id' => $this->owner->id, 'class_name' => $this->className]);
    }


}