<?php

namespace app\modules\catalog\widgets\cart\assets;

use yii\web\AssetBundle;

class WidgetAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $js = [
        'script.js',
        'update-count-all/script.js',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/../web';
        parent::init();

    }
}
