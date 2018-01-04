<?php
use \yii\helpers\Html;
use app\modules\main\components\Tr;
use  app\modules\admin\rbac\Rbac as AdminRbac;
?>
<div class="header-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="header-block-left">
                    <div class="header-badge">
                        <a class="header-badge-block">
                            <div class="header-badge-icon viber"></div>
                            <div class="header-badge-mark">2</div>
                        </a>
                        <a class="header-badge-block">
                            <div class="header-badge-icon skype"></div>
                            <div class="header-badge-mark">2</div>
                        </a>
                    </div>

                    <div class="phones-icon">
                        <i class="fa fa-mobile icon icon-green" aria-hidden="true"></i>
                    </div>
                    <div class="phone-block"><?=Tr::t('main', 'KIEV') ?> <a href="">(067) 672-40-80</a></div>
                    <div class="phone-block"><?=Tr::t('main', 'LVIV') ?> <a href="">(050) 758-59-05</a></div>
                </div>
                <div class="header-block-center">
                    <a href=""><?=Tr::t('main', 'CONTACTS') ?></a>
                    <span class="dist"></span>
                    <a href=""><?=Tr::t('main', 'DELIVERY_PAYMENT') ?></a>
                    <span class="dist"></span>
                    <a href=""><?=Tr::t('main', 'GUARANTEES') ?></a>
                </div>
                <div class="header-block-right">

                    <a href="">
                        <span class="group-icon-text">
                            <i class="glyphicon glyphicon-save icon" aria-hidden="true"></i>
                            <?=Tr::t('main', 'PRICE_LIST') ?>
                        </span>

                    </a>
                    <a href="">
                        <span class="group-icon-text">
                            <i class="fa fa-map-marker icon" aria-hidden="true"></i>
                            <?=Tr::t('main', 'TRACK_ORDER') ?>
                        </span>

                    </a>
                    <div style="display: inline-block; position: relative">
                        <a href="" data-toggle="dropdown">
                        <span class="group-icon-text">
                            <i class="fa fa-user icon" aria-hidden="true"></i>
                            <?=Tr::t('main', 'PERSONAL_AREA') ?>
                        </span>
                        </a>
                        <ul class="dropdown-menu">


                            <li><?=Html::a(Tr::t('main', 'NAV_EDIT_PROFILE'),  ['/user/profile/update'] ); ?></li>

                            <li>
                                <?
                                if(!\Yii::$app->user->isGuest) {
                                    echo Html::a(Tr::t('main', 'NAV_LOGOUT'),  ['/user/default/logout'], ['data-method' => 'post']);
                                } else {
                                    echo Html::a(Tr::t('main', 'NAV_LOGIN'),  ['/user/default/login'] );
                                }

                                ?>
                            </li>
                            <li class="divider"></li>

                            <? if(\Yii::$app->user->can(AdminRbac::PERMISSION_ADMIN_PANEL)): ?>
                                <li><?=Html::a(Tr::t('main', 'NAV_ADMIN'),  ['/admin/default/index'] ); ?></li>
                            <? endif; ?>
                        </ul>
                    </div>

                </div>


            </div>
        </div>

    </div>
</div>