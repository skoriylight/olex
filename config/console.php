<?php

return [
    'id' => 'app-console',
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'user' => [
            'class' => 'app\modules\user\Module',
            'controllerNamespace' => 'app\modules\user\controllers\console',
        ],
    ],

    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            
            'migrationTable' => 'migration',
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => [
                //'app\migrations',
                'lajax\translatemanager\migrations\namespaced',


            ],
        ],

        'migrate-property' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => 'migration_property',
            'migrationPath' => '@app/modules/property/migrations',
        ],

        'migrate-catalog' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => 'migration_catalog',
            'migrationPath' => '@app/modules/catalog/migrations',
        ],
        'migrate-main' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => 'migration_main',
            'migrationPath' => '@app/modules/main/migrations',
        ],

        'migrate-files' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => 'migration_files',
            'migrationPath' => '@app/components/files/migrations',
        ],

        'migrate-goods' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => 'migration_goods',
            'migrationPath' => '@app/modules/goods/migrations',
        ],

        'migrate-favorite' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => 'migration_favorite',
            'migrationPath' => '@app/modules/favorite/migrations',
        ],

        'migrate-order' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => 'migration_order',
            'migrationPath' => '@app/modules/order/migrations',
        ],



        'migrate-attribute' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => 'migration_attribute',
            'migrationPath' => '@app/modules/attribute/migrations',
        ],
    ],
];
