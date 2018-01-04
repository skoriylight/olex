<?php

namespace app\modules\catalog\widgets\frontend;

use yii\base\Widget;

Class ProductView extends Widget{

    const BLOCK_VIEW_ADAPT = 'block_view_adapt';
    const BLOCK_VIEW_3 = 'block_view_3';
    const BLOCK_VIEW_4 = 'block_view_4';
    const BLOCK_VIEW_5 = 'block_view_5';
    const LIST_VIEW = 'line_view';
    const LIST_PHOTO_VIEW = 'line_photo_view';
    const  VIEW_ARR = [self::BLOCK_VIEW_ADAPT, self::BLOCK_VIEW_3, self::BLOCK_VIEW_4, self::LIST_PHOTO_VIEW, self::LIST_VIEW];

    public $view = null;
    public $buy_block = true;
    public $marks = [];
    public $model;

    public function run(){
        if(is_null($this->view)) {
            $tab_view = isset($_COOKIE['tab_view'])?$_COOKIE['tab_view']:self::BLOCK_VIEW_4;
            $this->view = in_array($tab_view,self::VIEW_ARR)?$tab_view:self::BLOCK_VIEW_4;
        }


        return $this->render('product-view/'.$this->view,
            [
                'marks' => $this->marks,
                'buy_block' => $this->buy_block,
                'model' => $this->model,
                'buy_block' => $this->buy_block
            ]);
    }
}