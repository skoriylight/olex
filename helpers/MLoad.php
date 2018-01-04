<?php

namespace app\helpers;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class MLoad{

    public static function dataLoad($multipleModels = [], $modelClass, $attrName){

        $model    = new $modelClass;
        $formName = $model->formName();
        $singleArr = [];
        $post     =  \Yii::$app->request->post($formName);
        if (! empty($multipleModels)) {
            $singleArr = self::makeSingleArray($multipleModels);
            $keys = array_keys(ArrayHelper::map($singleArr, 'id', 'id'));
            $singleArr = array_combine($keys, $singleArr);
        }

        $models = static::arrParst($multipleModels , $post , $modelClass, $singleArr, $attrName, $formName );
        unset($model, $formName, $post);
        return $models;
    }

    protected static function arrParst($multipleModels = [], $post = [], $modelClass, $singleArr, $attrName, $formName){
        $models   = [];

            foreach ($post as $i => $item) {

                if(!isset($item[$attrName])) {
                    $models[$i] = static::arrParst($multipleModels, $item, $modelClass, $singleArr, $attrName, $formName);
                } else {

                    if (isset($item['id']) && !empty($item['id']) && isset($singleArr[$item['id']])) {
                        $models[$i] = $singleArr[$item['id']];

                    } else {
                        $models[$i] = new $modelClass;
                    }
                    $data[$formName] = $item;

                    $models[$i]->load($data);
                }
            }

            return $models;
    }



    public static function makeSingleArray($arr){
        if(!is_array($arr)) return false;
        $tmp = array();
        foreach($arr as $val){
            if(is_array($val)){
                $tmp = array_merge($tmp, static::makeSingleArray($val));
            } else {
                $tmp[] = $val;
            }
        }
        return $tmp;
    }

    public static function dataValidate($model){
        $valid  = true;
        $model = static::makeSingleArray($model);
        foreach ($model as $one) {
            $valid = $one->validate() && $valid;
        }

        return $valid;
    }

    public static function dataDelete($model, $oldModel){
        $model = static::makeSingleArray($model);
        $oldModel = static::makeSingleArray($oldModel);
        $oldModelIds = ArrayHelper::map($oldModel, 'id', 'id');
        $modeName = get_class($model[0]);
        $deletedModelIDs = array_diff($oldModelIds, array_filter(ArrayHelper::map($model, 'id', 'id')));
        if($deletedModelIDs){

            return $modeName::deleteAll(['id' => $deletedModelIDs]);
        }
        return true;

    }
}