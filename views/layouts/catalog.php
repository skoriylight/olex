<?php

use app\widgets\Alert;
use app\modules\admin\rbac\Rbac as AdminRbac;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\modules\main\components\Tr;

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
    <?= Alert::widget() ?>
    <div class="row">
        <div class="col-md-2">

            <?
            if(isset($this->params['category_container'])){
               // if ($this->beginCache('catalog-tree', ['duration' => 3600*48])) {
                   echo  \app\modules\catalog\widgets\frontend\CategoryTree::widget();
               //     $this->endCache();
                //}
            }

            ?>
            <?
            echo isset($this->params['filter_container'])? \app\modules\catalog\widgets\frontend\ProductFilterForm::widget(
                ['category_id' => isset($this->params['category_id']) ? $this->params['category_id'] : null]
            ): '';
            ?>
        </div>
        <div class="col-md-10">

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],

            ]) ?>
            <div class="row">
                <div class="col-md-9">
                    <? echo isset($this->params['carousel_container'])? $this->render('parts/_carousel'): ''; ?>
                </div>
            </div>
            <div class="margin-block"></div>
            <?= $content ?>

            <div class="margin-block"></div>
            <div class="ad-container flexbox flex-vertical-center flex-align-center">
                <span>Рекламный блок</span>
            </div>
            <div class="margin-block"></div>
        </div>
    </div>

</div>


<?php $this->endContent(); ?>
