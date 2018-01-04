<?php
use app\modules\main\components\Tr;
use yii\helpers\Url;
?>
<div class="item-sector">
    <div class="prd prd-default">
        <div class="prd-border">
            <a class="prd-img" style="background-image: url(<?=\Yii::$app->imageresize->getUrl(trim($model->firstImage,'/'), 250, 250); ?>);" href="<?=Url::to(['/catalog/default/view', 'product_slug' => $model->slug]); ?>"></a>
            <a class="prd-img-back" href="<?=Url::to(['/catalog/default/view', 'product_slug' => $model->slug]); ?>" style="background-image: url(<?=\Yii::$app->imageresize->getUrl(trim($model->secondImage,'/'), 250, 250); ?>);"></a>
            <a class="prd-img-variable" href="<?=Url::to(['/catalog/default/view', 'product_slug' => $model->slug]); ?>" id="img-variable-<?=$model->id; ?>" ></a>
            <h4 class="prd-title"><a href="<?=Url::to(['/catalog/default/view', 'product_slug' => $model->slug]); ?>"><?= $model->name; ?></a></h4>
            <div class="row">
                <div class="col-md-4 col-xs-4">
                    <div class="prd-old-price"><span>$0.00</span></div>
                </div>
                <div class="col-md-4 col-xs-4">
                    <div class="prd-price"><span><b><?= "$ $model->price" ?></b></b></span></div>
                </div>
                <div class="col-md-4 col-xs-4">

                    <?=\app\modules\favorite\widgets\Button::widget(['model' => $model->good]); ?>
                </div>
            </div>
            <? if($buy_block): ?>
            <div class="prd-btn-buy">
                <button type="button" class="btn btn-color-select" data-toggle="collapse" data-target="#toggleSampleItem<?=$model->id ?>">
                    <?=Tr::t('catalog-main' , 'SELECT_COLOR'); ?>
                </button>

                <div id="toggleSampleItem<?=$model->id ?>" class="prod-price-box collapse ">
                    <form class="form-horizontal">
                        <? foreach ($model->goods as $child): ?>


                            <div class="goods-group clearfix" data-img="<?='/'.$child->path ?>" data-img-id="img-variable-<?=$model->id; ?>">
                                <div class="col-xs-3"><input type="text" class="form-control"></div>
                                <div class="col-xs-9"><label><?= $child->name; ?></label></div>


                            </div>
                        <? endforeach; ?>
                        <input class="btn prd-buy" value="<?=Tr::t('catalog-main' , 'BTN_BUY'); ?>" type="submit">
                    </form>
                </div>
            </div>
            <? endif; ?>

        </div>
    </div>

</div>


