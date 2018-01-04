<?php

use app\widgets\Alert;
use app\modules\main\components\Tr;
use app\modules\admin\rbac\Rbac as AdminRbac;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginContent('@app/views/layouts/layout.php'); ?>

<?php
/*
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'activateParents' => true,
    'items' => array_filter([
        ['label' => Yii::t('app', 'NAV_HOME'), 'url' => ['/main/default/index']],
        ['label' => Yii::t('app', 'NAV_CONTACT'), 'url' => ['/main/contact/index']],
        Yii::$app->user->isGuest ?
            ['label' => Yii::t('app', 'NAV_SIGNUP'), 'url' => ['/user/default/signup']] :
            false,
        Yii::$app->user->isGuest ?
            ['label' => Yii::t('app', 'NAV_LOGIN'), 'url' => ['/user/default/login']] :
            false,
        Yii::$app->user->can(AdminRbac::PERMISSION_ADMIN_PANEL) ?
            ['label' => Yii::t('app', 'NAV_ADMIN'), 'url' => ['/admin/default/index']] :
            false,
        !Yii::$app->user->isGuest ?
            ['label' => Yii::t('app', 'NAV_PROFILE'), 'items' => [
                ['label' => Yii::t('app', 'NAV_PROFILE'), 'url' => ['/user/profile/index']],
                ['label' => Yii::t('app', 'NAV_LOGOUT'),
                    'url' => ['/user/default/logout'],
                    'linkOptions' => ['data-method' => 'post']]
            ]] :
            false,
    ]),
]);

NavBar::end();
*/
?>

<div class="container-fluid">


    <?= Alert::widget() ?>
    <div class="margin-block"></div>
    <div class="text-center">
        <?php echo Html::a(Tr::t('profile', 'PERSONAL_AREA') . ': '
            . (!empty(\Yii::$app->user->identity->full_name) ? \Yii::$app->user->identity->full_name : \Yii::$app->user->identity->username),
            ['/user/profile/update'], ['class' => 'btn btn-save']) ?>

    </div>
    <div class="margin-block"></div>
    <div class="row">
        <div class="col-md-2">
            <?
            echo \yii\widgets\Menu::widget([
                'items' => [
                    ['label' => Tr::t('cabinet', 'NAV_SETTLEMENTS'), 'url' => ['/']],
                    ['label' => Tr::t('cabinet', 'NAV_ORDER_LIST'), 'url' => ['/order/default/order-list']],
                    ['label' => Tr::t('cabinet', 'NAV_CUSTOMER_PROFILE'), 'url' => ['/user/profile/update']],
                    ['label' => Tr::t('cabinet', 'NAV_PASS_RESET'), 'url' => ['/user/profile/password-change']],
                ],
                'options' => [
                    'class' => 'nav-cabinet',

                ],
                'linkTemplate' => '<a href="{url}">{label}</a>
                    <div class="cabinet-nav-label"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>',
            ])
            ?>
        </div>
        <div class="col-md-10">


            <?= $content ?>

            <div class="margin-block"></div>
        </div>
    </div>

</div>


<?php $this->endContent(); ?>
