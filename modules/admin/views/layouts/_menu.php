<?php

use app\widgets\Alert;
use app\modules\admin\Module;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;


NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);

$context = $this->context;
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'activateParents' => true,
    'items' => array_filter([
        ['label' => Yii::t('app-main', 'NAV_CLEAR_CACHE'), 'url' => ['/admin/settings/default/clear']],
        ['label' => Yii::t('app-main', 'NAV_SETTINGS'), 'url' => ['/admin/settings/index']],
        ['label' => Yii::t('app-main', 'NAV_ADMIN_USERS'), 'url' => ['/admin/user/default/index'], 'active' => $context->module->id == 'users'],
        ['label' => Yii::t('app-main', 'NAV_LOGOUT'), 'url' => ['/user/default/logout'], 'linkOptions' => ['data-method' => 'post']],
        ['label' => Yii::t('app-main', 'NAV_ADMIN_SHOP'), 'items' => [
            ['label' => Yii::t('app-main', 'NAV_ADMIN_SHOP_CATALOG_CATEGORY'), 'url' => ['/admin/catalog/category/index']],
            ['label' => Yii::t('app-main', 'NAV_ADMIN_SHOP_CATALOG_PRODUCT'), 'url' => ['/admin/catalog/product/index']],
            ['label' => Yii::t('app-main', 'NAV_ADMIN_SHOP_ORDER'), 'url' => ['/admin/order/order/index']],
            ['label' => Yii::t('app-main', 'NAV_ADMIN_SHOP_ORDER_SHIPPING'), 'url' => ['/admin/order/order-shipping-type/index']],
            ['label' => Yii::t('app-main', 'NAV_ADMIN_SHOP_PROPERTY'), 'url' => ['/admin/property/default/index']],
        ]],

        ['label' => Yii::t('app-main', 'NAV_ADMIN_TRANSLATE_MANAGER'), 'items' => [
            ['label' => Yii::t('app-main', 'NAV_ADMIN_TRANSLATE_MANAGER_LIST'), 'url' => ['/admin/translatemanager/language/list']],
            ['label' => Yii::t('app-main', 'NAV_ADMIN_TRANSLATE_MANAGER_SCAN'), 'url' => ['/admin/translatemanager/language/scan']],
            ['label' => Yii::t('app-main', 'NAV_ADMIN_TRANSLATE_MANAGER_OPTIMIZER'), 'url' => ['/admin/translatemanager/language/optimizer']],
            ['label' => Yii::t('app-main', 'NAV_ADMIN_TRANSLATE_MANAGER_IMPORT'), 'url' => ['/admin/translatemanager/language/import']],
            ['label' => Yii::t('app-main', 'NAV_ADMIN_TRANSLATE_MANAGER_EXPORT'), 'url' => ['/admin/translatemanager/language/export']]
        ]]
    ]),
]);
NavBar::end();
?>