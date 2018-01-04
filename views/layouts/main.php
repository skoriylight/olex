<?php

use app\widgets\Alert;
use app\modules\admin\rbac\Rbac as AdminRbac;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use \app\modules\main\components\Tr;
use app\modules\attribute\widgets\MarkSlider;

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
    <?php echo \app\modules\catalog\widgets\frontend\BrandForm::widget([]); ?>


    <div class="margin-block"></div>


    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?>

    <?= Alert::widget() ?>
    <?= $this->render('parts/_attr-labels'); ?>
    <div class="margin-block"></div>
    <div class="row">
        <div class="col-md-2">

            <?= $this->render('parts/_category'); ?>
            <?
            if ($this->beginCache('catalog-tree', ['duration' => 3600 * 48])) {
                echo \app\modules\catalog\widgets\frontend\CategoryTree::widget();
                $this->endCache();
            }
            ?>

        </div>
        <div class="col-md-10">

            <div class="ad-container flexbox flex-vertical-center flex-align-center">
                <span>Рекламный блок</span>
            </div>


            <div class="margin-block"></div>

            <div class="row">
                <div class="col-md-9">
                    <?= $this->render('parts/_carousel'); ?>


                </div>
                <div class="col-md-3">
                    <div style="height: 127px" class="ad-container flexbox flex-vertical-center flex-align-center">
                        <span>Рекламный блок</span>
                    </div>
                    <div class="margin-block"></div>
                    <div style="height: 126px" class="ad-container flexbox flex-vertical-center flex-align-center">
                        <span>Рекламный блок</span>
                    </div>
                </div>
            </div>
            <div class="margin-block"></div>
            <?= $content ?>
        </div>
    </div>

    <div class="margin-block"></div>
    <?php echo \app\modules\catalog\widgets\frontend\ConsumablesForm::widget([]); ?>
    <div class="margin-block"></div>

    <div class="row">
        <div class="col-md-2">
            <div style="height: 370px" class="ad-container flexbox flex-vertical-center flex-align-center">
                <span>Рекламный блок</span>
            </div>
            <div class="margin-block"></div>
            <div style="height: 370px" class="ad-container flexbox flex-vertical-center flex-align-center">
                <span>Рекламный блок</span>
            </div>
        </div>
        <div class="col-md-10">
            <?= MarkSlider::widget([
                'label_mark_label' => Tr::t('main', 'MARK_SALE'),
                'label_mark_icon' => 'sale',
                'mark_name' => MarkSlider::MARK_SALE
            ]); ?>
            <div class="margin-block"></div>

            <?= MarkSlider::widget([
                'label_mark_label' => Tr::t('main', 'MARK_STOCK'),
                'label_mark_icon' => 'A',
                'mark_name' => MarkSlider::MARK_STOCK
            ]); ?>
            <div class="margin-block"></div>


            <?= $content ?>
        </div>
    </div>
    <div class="ad-container flexbox flex-vertical-center flex-align-center">
        <span>Рекламный блок</span>
    </div>
    <div class="margin-block"></div>


    <div class="row">

        <div class="col-md-10">
            <?= MarkSlider::widget([
                'label_mark_label' => Tr::t('main', 'MARK_NEW'),
                'label_mark_icon' => 'new',
                'mark_name' => MarkSlider::MARK_NEW
            ]); ?>
            <div class="margin-block"></div>

            <?= MarkSlider::widget([
                'label_mark_label' => Tr::t('main', 'MARK_HIT'),
                'label_mark_icon' => 'hit',
                'mark_name' => MarkSlider::MARK_HIT
            ]); ?>
            <div class="margin-block"></div>


            <?= $content ?>
        </div>

        <div class="col-md-2">
            <div style="height: 370px" class="ad-container flexbox flex-vertical-center flex-align-center">
                <span>Рекламный блок</span>
            </div>
            <div class="margin-block"></div>
            <div style="height: 370px" class="ad-container flexbox flex-vertical-center flex-align-center">
                <span>Рекламный блок</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $this->render('parts/_about-block') ?>

        </div>
    </div>

    <div class="margin-block"></div>

</div>

<?php $this->endContent(); ?>
