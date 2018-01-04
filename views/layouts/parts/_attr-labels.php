<?php
use app\modules\main\components\Tr;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-2">
        <?= \app\modules\catalog\widgets\frontend\CategoryPop::widget(); ?>
    </div>
    <div class="col-md-10 flexbox flex-align-between">
        <a class="attr-label attr-new" href="<?=Url::to(['/catalog/default/index', 'ProductSearch[attr_mark][is_new]' => 1]) ?>">
            <div class="attr-icon attr-new">new</div>
            <?=Tr::t('main', 'MARK_NEW') ?> 10
        </a>

        <a class="attr-label attr-sale" href="<?=Url::to(['/catalog/default/index', 'ProductSearch[attr_mark][is_sale]' => 1]) ?>">
            <div class="attr-icon attr-sale">sale</div>
            <?=Tr::t('main', 'MARK_SALE') ?> 10
        </a>

        <a class="attr-label attr-hit" href="<?=Url::to(['/catalog/default/index', 'ProductSearch[attr_mark][is_hit]' => 1]) ?>">
            <div class="attr-icon attr-hit">hit</div>
            <?=Tr::t('main', 'MARK_HIT') ?> 10
        </a>

        <a class="attr-label attr-coming" href="<?=Url::to(['/catalog/default/index', 'ProductSearch[attr_mark][is_coming]' => 1]) ?>">
            <div class="attr-icon attr-coming"><i class="glyphicon glyphicon-time"></i></div>
            <?=Tr::t('main', 'MARK_COMING') ?> 10
        </a>

        <a class="attr-label attr-stock" href="<?=Url::to(['/catalog/default/index', 'ProductSearch[attr_mark][is_stock]' => 1]) ?>">
            <div class="attr-icon attr-stock">A</div>
            <?=Tr::t('main', 'MARK_STOCK') ?> 10
        </a>
    </div>
</div>