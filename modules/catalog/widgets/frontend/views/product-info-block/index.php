<?php
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-5">
        <?= \edofre\sliderpro\SliderPro::widget([
            'id'            => 'product-slider',
            'slides'        => $model->getSliderImages(),
            'thumbnails'    => $model->getSliderImages(true),
            'sliderOptions' => [
                'width'  => 450,
                'height' => 480,
                'autoplay' => false,
                'buttons' => false,
                'arrows' => true,
                'init'   => new \yii\web\JsExpression("
			function() {
			
				
			}
		"),
            ],
        ]);
        ?>
    </div>
    <div class="col-md-7">
        <h3 class="product-title"><?= Html::encode($this->title) ?></h3>
        <div class="product-info-block">
            <div class="product-sku">
                <?=\app\modules\main\components\Tr::t('catalog-main', 'ARTICLE') ?>: <?=$model->article ?>
            </div>
            <div class="product-available"><?=\app\modules\main\components\Tr::t('catalog-main', 'IN_STOCK') ?></div>

            <div class="product-price">
                <?='$ '.$model->price; ?>
            </div>

        </div>
        <?=\app\modules\catalog\widgets\cart\BuyBtn::widget(['page' => 'view-block', 'model' => $model]); ?>
    </div>
</div>