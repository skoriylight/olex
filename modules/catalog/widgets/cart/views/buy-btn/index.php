<?php

if(count($model->goods) > 1) {
    echo $this->render('_buy_multi', ['model' => $model, 'url' => $url]);
} else {
    echo $this->render('_buy_single', ['model' => $model, 'child'=>$model->goods[0], 'url' => $url]);
}