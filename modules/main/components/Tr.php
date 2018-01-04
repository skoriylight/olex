<?php

namespace app\modules\main\components;

Class Tr{

    public static function t($category, $message, $params = [], $language = null){
        return \Yii::t($category, $message, $params = [], $language);
    }
}