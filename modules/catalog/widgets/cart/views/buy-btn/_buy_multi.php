<?
use app\modules\main\components\Tr;
?>

<div class="prd-btn-buy">
    <button type="button" class="btn btn-color-select" data-toggle="collapse" data-target="#toggleSampleItem<?=$model->id ?>">
        <?=Tr::t('catalog-main' , 'SELECT_COLOR'); ?>
    </button>

    <div id="toggleSampleItem<?=$model->id ?>" class="prod-price-box collapse ">
        <form class="form-horizontal form-product-add" data-title="<?=$model->name ?>" data-role="cart-buy-form" action="<?=$url ?>">
            <? foreach ($model->goods as $child): ?>


                <div class="goods-group clearfix" data-img="<?=$child->image ?>" data-img-id="img-variable-<?=$model->id; ?>">
                    <div class="col-xs-3">


                        <?
                        echo \kartik\touchspin\TouchSpin::widget([
                            'name' => "prod[$child->id]",
                            'options' => [
                                'class' => 'form-control',
                                'data-id' => $child->id,
                                'data-url' => \yii\helpers\Url::toRoute(['/catalog/cart/update-count']),
                            ],
                            'pluginOptions' => [
                                'initval' => 1,
                                'min' => 0,
                                //'max' => 100,
                                'step' => 1,
                                'decimals' => 0,
                                'buttonup_txt' => '<i class="glyphicon glyphicon-plus"></i>',
                                'buttondown_txt' => '<i class="glyphicon glyphicon-minus"></i>',
                                'verticalbuttons' => true,

                            ],
                        ]);
                        ?>

                    </div>
                    <div class="col-xs-6"><label><?= $child->name; ?></label>


                    </div>
                    <div class="col-xs-3" >
                        <label data-cart-count-icon-id="<?=$child->id ?>" class="goods-bag-count">
                            <span class="icon-bag-grey">

                            </span>
                        </label>


                    </div>


                </div>
            <? endforeach; ?>
            <input class="btn prd-buy" value="<?=Tr::t('catalog-main' , 'BTN_BUY'); ?>" type="submit">
        </form>
    </div>
</div>