<?php

use yii\helpers\ArrayHelper;

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');
Yii::setAlias('@layouts', dirname(__DIR__) . '/views/layouts');

$params = ArrayHelper::merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'name' => 'Mobimag',
    'basePath' => dirname(__DIR__),

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => [
        'log',
        'app\modules\admin\Bootstrap',
        'app\modules\main\Bootstrap',
        'app\modules\user\Bootstrap',


    ],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
        ],
        'urlManager' => [
            'class' => 'app\modules\main\components\UrlManager',
            'languages' => ['ru'=>'ru-RU', 'en'=>'en-EN'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\web\GroupUrlRule',

                    'prefix' => 'admin',
                    'routePrefix' => 'admin',
                    'rules' => [
                        '' => 'catalog/product',
                        '<_m:[\w\-]+>' => '<_m>/default/index',
                        '<_m:[\w\-]+>/<id:\d+>' => '<_m>/default/view',
                        '<_m:[\w\-]+>/<id:\d+>/<_a:[\w-]+>' => '<_m>/default/<_a>',
                        '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
                        '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
                        '<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
                    ],
                ],

                [

                    'class' => 'app\modules\catalog\components\CategoryUrlRule',
                ],

               /* [
                    'class' => 'app\modules\catalog\components\CategoryUrlRule',
                    
                ],*/

                '' => 'catalog/default/main',
                'contact' => 'main/contact/index',
                '<_a:error>' => 'main/default/<_a>',
                'tree/<_a:[\w-]+>' => 'main/tree/<_a>',
                '<_a:(login|logout|signup|email-confirm|password-reset-request|password-reset)>' => 'user/default/<_a>',
                'admin/translatemanager/<_c:[\w\-]+>/<_a:[\w\-]+>' => '/translatemanager/<_c>/<_a>',
                '<_m:[\w\-]+>' => '<_m>/default/index',
                '<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w-]+>' => '<_m>/<_c>/<_a>',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
            ],
        ],
        'authManager' => [
            'class' => 'elisdn\hybrid\AuthManager',
            'modelClass' => 'app\components\UserIdentity',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                    'cachingDuration' => 86400,
                    'enableCaching' => true,
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'cache' => [
            'class' => 'yii\caching\DummyCache',
            /*'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => 'localhost',
                    'port' => 11211,
                    'weight' => 60,
                ],

            ],*/
        ],
        'log' => [
            'class' => 'yii\log\Dispatcher',
        ],
        'translatemanager' => [
            'class' => 'lajax\translatemanager\Component'
        ],



    ],

    'params' => $params,
];