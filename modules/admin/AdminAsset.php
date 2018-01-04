<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\admin;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{

    public $sourcePath = '@app/modules/admin/assets';
    public $css = [

        'css/bootstrap.min.css',
        'css/main.css',
    ];
    public $js = [
    ];
    public $depends = [
        'app\assets\Html5ShivAsset',
        'app\assets\RespondAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
