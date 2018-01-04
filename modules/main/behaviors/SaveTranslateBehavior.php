<?php

namespace app\modules\main\behaviors;

use app\modules\main\models\Translate;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class SaveTranslateBehavior extends Behavior
{
    //public $languages = [];
    public $attributes_tr = [];
    public $postAttribute = 'translate_t';
    protected $translateModel = [];


    public function attach($owner)
    {
        parent::attach($owner);
        $this->attributes_tr = $this->owner->attributes_translate;
    }

    public function generateFieldsArray()
    {
        $arr = [];
        $translateModel = $this->translateModel;
        foreach ($this->owner->languages as $language) {
            $model = $this->owner->loadAttributes_t($language);
            //print_r($model);
            foreach ($this->attributes_tr as $attribute) {
                if(isset($model[$attribute])) {
                    $this->translateModel[$attribute][$language] = $model[$attribute];
                } else {
                    $this->translateModel[$attribute][$language] = $this->createTranslateModel($attribute,$language);
                }
                $arr[$attribute][$language] = $this->translateModel[$attribute][$language]->message;
            }
        }
        return $arr;
    }

    public function createTranslateModel($attribute,$language){
        $model = new $this->owner->translateTableClass;
        $model->language_id = $language;
        $model->attribute = $attribute;
        $model->class_name = $this->owner->className;
        return $model;

    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
        ];
    }

    public function afterFind(){
        $postAttribute = $this->postAttribute;
        $this->owner->$postAttribute = $this->generateFieldsArray();
    }


    public function afterSave(){
        $postAttribute = $this->postAttribute;

        foreach($this->translateModel as $attribute => $models) {
            foreach($models as $language => $model){
                $model->message = $this->owner->$postAttribute[$attribute][$language];
                $model->model_id = $this->owner->id;
                $model->save();
            }
        }


    }
}