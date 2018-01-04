<?php

namespace app\modules\catalog\widgets\frontend\assets;

use yii\web\AssetBundle;

class BtnToggleViewAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $js = [
        'btn-toggle-view.js',

    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/../web';
        parent::init();

    }
}
