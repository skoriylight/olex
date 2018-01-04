<div class="header-main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <a href="<?=\yii\helpers\Url::to(['/']) ?>" class="header-main-part flexbox flex-vertical-center" id="logo-main">
                    <img src="/images/logo.png" alt="">
                </a>
            </div>
            <div class="col-md-6">
                <div class="header-main-part flexbox flex-vertical-center">
                    <span class="input-search">
                        <input type="text" />
                        <button class="btn btn-search"><?=\app\modules\main\components\Tr::t('main','BTN_SEARCH') ?></button>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="header-main-part flexbox flex-vertical-center flex-align-end">





                        <?=\app\modules\main\widgets\LanguageSwitch::widget(['languages' => \Yii::$app->urlManager->languages]); ?>

                    <a class="small-mark-group">
                        <div class="small-mark-icon icon-bell active"></div>
                        <div class="small-mark-label"> 0 / 0</div>
                    </a>

                    <a class="small-mark-group" href="<?=\yii\helpers\Url::to(['/catalog/cart', 'view' => 'favorite']) ?>">
                        <div class="small-mark-icon icon-heart"></div>
                        <div class="small-mark-label" data-model="<?=$count_class = \app\modules\goods\models\Goods::className(); ?>" data-role="favorite-count-btn">
                            <?=isset(\Yii::$app->favorite->count[$count_class])?\Yii::$app->favorite->count[$count_class]:0; ?>
                        </div>
                    </a>

                    <a class="small-mark-group" href="<?=\yii\helpers\Url::to(['/catalog/cart']) ?>">
                        <div class="small-mark-icon icon-bag active"></div>
                        <div class="small-mark-label">
                            <?= \dvizh\cart\widgets\CartInformer::widget(['htmlTag' => 'span', 'offerUrl' => '', 'text' => '{c}']); ?>
                        </div> шт.

                            <?= \dvizh\cart\widgets\CartInformer::widget(['htmlTag' => 'span', 'cssClass'=>'bottom-mark-label', 'offerUrl' => '', 'text' => 'на {p}']); ?>

                    </a>

                </div>
            </div>
        </div>
    </div>
</div>