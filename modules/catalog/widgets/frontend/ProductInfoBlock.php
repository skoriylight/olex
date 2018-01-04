<?php

namespace app\modules\catalog\widgets\frontend;

use yii\base\Widget;

Class ProductInfoBlock extends Widget{

    public $model = null;


    public function run(){


        return $this->render('product-info-block/index',['model' => $this->model]);
    }
}