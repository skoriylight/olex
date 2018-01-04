<?php

namespace app\modules\goods\models;

use yii\helpers\ArrayHelper;

Class GoodsHistory extends Goods{


    public static function getFromOriginal($models, $attr = 'item_id'){
        $ids = ArrayHelper::map($models, $attr, $attr);
        return self::find()->where(['id' => $ids])->all();
    }

    public static function addHistoryFaforite($models, $attr = 'item_id'){
        foreach (self::getFromOriginal($models) as $model){
            \Yii::$app->favorite->put($model);
        }
    }
}