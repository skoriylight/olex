<?php
use app\modules\main\components\Tr;
use yii\helpers\Url;
?>
<div class="col-md-3 col-lg-3 col-sm-4 item-sector" style="z-index: <?=\Yii::$app->params['z_index_item']--; ?>">
    <div class="prd prd-default">
        <div class="prd-border">
            <a class="prd-img" style="background-image: url(<?=\Yii::$app->imageresize->getUrl(trim($model->firstImage,'/'), 250, 250); ?>);" href="<?=Url::to(['/catalog/default/view', 'product_slug' => $model->slug]); ?>"></a>
            <a class="prd-img-back" href="<?=Url::to(['/catalog/default/view', 'product_slug' => $model->slug]); ?>" style="background-image: url(<?=\Yii::$app->imageresize->getUrl(trim($model->secondImage,'/'), 250, 250); ?>);"></a>
            <a class="prd-img-variable" href="<?=Url::to(['/catalog/default/view', 'product_slug' => $model->slug]); ?>" id="img-variable-<?=$model->id; ?>" ></a>
            <h4 class="prd-title"><a href="<?=Url::to(['/catalog/default/view', 'product_slug' => $model->slug]); ?>"><?= $model->name; ?></a></h4>
            <div class="row">
                <div class="col-md-4 col-xs-4">
                    <div class="prd-old-price"><span><?= "$$model->old_price" ?></span></div>
                </div>
                <div class="col-md-4 col-xs-4">
                    <div class="prd-price"><span><b><?= "$$model->price" ?></b></b></span></div>
                </div>
                <div class="col-md-2 col-xs-2">
                    <?=\app\modules\favorite\widgets\Button::widget(['model' => $model->good]); ?>
                </div>
                <div class="col-md-2 col-xs-2">
                    <?=\app\modules\catalog\widgets\modalajax\ModalAjax::widget([
                        'url' => Url::to(['/catalog/default/view-modal', 'product_slug' => $model->slug])
                    ]); ?>
                </div>

            </div>

            <?
            echo app\modules\catalog\widgets\cart\BuyBtn::widget(['model' => $model
            ]);

            ?>


        </div>
    </div>

</div>


