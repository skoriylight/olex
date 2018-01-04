<?php
use app\modules\main\components\Tr;
use yii\helpers\Url;
?>

<div class="prd prd-line">
    <div class="prd-sector-title">
        <a href="<?=Url::to(['/catalog/default/view', 'product_slug' => $model->slug]); ?>"><?= $model->name; ?></a>
    </div>
    <div class="prd-sector-view"></div>
    <div class="prd-sector-favorite"><?=\app\modules\favorite\widgets\Button::widget(['model' => $model->good]); ?></div>
    <div class="prd-sector-old-price prd-old-price"><span><?= "$$model->old_price" ?></span></div>
    <div class="prd-sector-price prd-price"><span><b><?= "$$model->price" ?></b></span></div>
    <div class="prd-sector-btn">
        <? echo app\modules\catalog\widgets\cart\BuyBtn::widget(['model' => $model]); ?>
    </div>
</div>


