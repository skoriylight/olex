<?php

namespace app\modules\catalog\widgets\frontend;

use yii\base\Widget;

Class MenuBlock extends Widget{

    public $containerClass = 'catalog-menu-block';
    public $title = false;
    public $items = [];
    public $nameAttribute;

    public function run(){
        return $this->render('menu-block/index',
            [
                'containerClass' => $this->containerClass,
                'title' => $this->title,
                'items' => $this->items,
                'nameAttribute' => $this->nameAttribute,
                ]);
    }
}