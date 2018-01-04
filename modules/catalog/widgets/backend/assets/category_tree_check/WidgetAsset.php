<?php

namespace app\modules\catalog\widgets\backend\assets\category_tree_check;

use yii\web\AssetBundle;

class WidgetAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $js = [
        'script.js',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/../../web/category_tree_check';
        parent::init();

    }
}
