<?php

$config = [
    'id' => 'app',
    'language' => 'ru-RU',
    'layout' => '@app/views/layouts/default',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => '@app/modules/admin/views/layouts/admin',
            'defaultRoute' => 'product',

            'modules' => [
                'user' => [
                    'class' => 'app\modules\user\Module',
                    'controllerNamespace' => 'app\modules\user\controllers\backend',
                    'viewPath' => '@app/modules/user/views/backend',
                ],


                'catalog' => [
                    'class' => 'app\modules\catalog\Module',
                    'controllerNamespace' => 'app\modules\catalog\controllers\backend',
                    'viewPath' => '@app/modules/catalog/views/backend',
                ],

                'order' => [
                    'class' => 'app\modules\order\Module',
                    'controllerNamespace' => 'app\modules\order\controllers\backend',
                    'viewPath' => '@app/modules/order/views/backend',
                ],

                'settings' => [
                    'class' => 'app\modules\settings\Module',

                ],

                'settings-fields' => [
                    'class' => 'pheme\settings\Module',
                    'sourceLanguage' => 'ru'
                ],

                'goods' => [
                    'class' => 'app\modules\goods\Module',
                ],

                'property' => [
                    'class' => 'app\modules\property\Module',
                ],



            ],

        ],

        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],

        'main' => [
            'class' => 'app\modules\main\Module',
            'controllerMap' => [
                'tree' => 'arogachev\tree\controllers\TreeController',
            ],
        ],

        'translatemanager' => [
            'class' => 'lajax\translatemanager\Module',
            'layout' => '@app/modules/admin/views/layouts/admin',
            'root' => [
                '@app/modules',
                '@app/views'
            ],
            'allowedIPs' => ['*'],  // IP addresses from which the translation interface is accessible.
            'roles' => ['@'],
        ],


        'user' => [
            'class' => 'app\modules\user\Module',
            'controllerNamespace' => 'app\modules\user\controllers\frontend',
            'viewPath' => '@app/modules/user/views/frontend',
        ],
        'property' => [
            'class' => 'app\modules\property\Module',
        ],

        'catalog' => [
            'class' => 'app\modules\catalog\Module',
            'controllerNamespace' => 'app\modules\catalog\controllers\frontend',
            'viewPath' => '@app/modules/catalog/views/frontend',
        ],

        'cart' => [
            'class' => 'dvizh\cart\Module',
        ],


        'favorite' => [
            'class' => 'app\modules\favorite\Module',
        ],


        'order' => [
            'class' => 'app\modules\order\Module',
            'controllerNamespace' => 'app\modules\order\controllers\frontend',
            'viewPath' => '@app/modules/order/views/frontend',
        ],

        'comment' => [
            'class' => 'yii2mod\comments\Module',
        ],


    ],
    'components' => [
        'user' => [
            'identityClass' => 'app\components\UserIdentity',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/default/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'main/default/error',
        ],
        'request' => [
            'cookieValidationKey' => 'LtZwZbAL1Z0syBA-QaGdbP0xHQToujhn',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [/*'css/bootstrap.css',*/],
                ],
                'yii2mod\alert\AlertAsset' => [
                    'css' => [
                        'dist/sweetalert.css',
                        'themes/twitter/twitter.css',
                    ]
                ]
            ],
        ],

        'fileStorage' => [
            'class' => 'trntv\filekit\Storage',
            'baseUrl' => '@web/uploads',
            'filesystem' => function () {
                $adapter = new \League\Flysystem\Adapter\Local('uploads');
                return new League\Flysystem\Filesystem($adapter);
            }

        ],

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'db' => 'db',
                    //'sourceLanguage' => 'ru-RU', // Developer language
                    'sourceMessageTable' => '{{%language_source}}',
                    'messageTable' => '{{%language_translate}}',
                    'cachingDuration' => 86400,
                    'enableCaching' => true,
                ],
            ],
        ],


        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => '.',
            'thousandSeparator' => ' ',
            'currencyCode' => 'USD',
            'locale' => 'en_US'
        ],


        'settings' => [
            'class' => 'pheme\settings\components\Settings'
        ],

        'cart' => [
            'class' => 'dvizh\cart\Cart',
            'currency' => '$', //Валюта
            'currencyPosition' => 'before', //after или before (позиция значка валюты относительно цены)
            'priceFormat' => [2, '.', ''], //Форма цены
        ],

        'favorite' => [
            'class' => 'app\modules\favorite\Favorite',

        ],

        'order' => [
            'class' => 'app\modules\order\Order',
        ],

        'shop' => [
            'class' => 'app\modules\catalog\Shop'
        ],


        'imageresize' => [
            'class' => 'noam148\imageresize\ImageResize',
            //path relative web folder
            'cachePath' => 'assets/images',
            //use filename (seo friendly) for resized images else use a hash
            'useFilename' => true,
            //show full url (for example in case of a API)
            'absoluteUrl' => false,
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
