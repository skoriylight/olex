<?php

namespace app\modules\catalog\widgets\modalajax;

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
        $this->sourcePath = __DIR__ . '/web';
        parent::init();

    }
}
