<?
use app\modules\main\components\Tr;
$inc = 0;
$products_count = 5;
?>


<form class="form" data-role="cart-buy-form" data-title="<?=$model->name ?>" action="<?= $url ?>">
    <table class="table">


        <? foreach ($model->goods as $child): ?>
            <?php
            if($inc == $products_count){
                echo \yii\helpers\Html::beginTag('tbody',['class' => 'collapse', 'id' => 'product-collapse']);
            }
            ?>
            <tr>
                <td width="50px"><div class="box-color" style="background-color: <?=$child->color ?>"></div></td>
                <td><?= $child->name ?> </td>
                <td>
                    <div class="form-touch-min">
                        <table >
                            <tr>
                                <td style="padding-right: 10px"><?
                                    echo \kartik\touchspin\TouchSpin::widget([
                                        'name' => "prod[$child->id]",
                                        'id' => "prod_view_id_$child->id",
                                        'options' => [
                                            'class' => 'form-control form-buy-group',

                                            'data-id' => $child->id,
                                            'data-url' => \yii\helpers\Url::toRoute(['/catalog/cart/update-count']),
                                        ],
                                        'pluginOptions' => [

                                            'initval' => 1,
                                            'min' => 0,
                                            //'max' => 100,
                                            'step' => 1,
                                            'decimals' => 0,
                                            'buttonup_txt' => '+',
                                            'buttondown_txt' => '-',
                                            'verticalbuttons' => false,

                                        ],
                                    ]);
                                    ?></td>
                                <td> <?=Tr::t('catalog-main', 'LABEL_COUNT'); ?></td>
                            </tr>
                        </table>

                    </div>
                </td>
                <td>
                    <label data-cart-count-icon-id="<?= $child->id ?>" class="goods-bag-count flex-inline">
                            <span class="icon-bag-grey">

                            </span>
                    </label>
                </td>
                <td>
                    <?=\app\modules\favorite\widgets\Button::widget(['model' => $child]); ?>
                </td>
                <td>

                </td>


            </tr>
            <?php
            $inc++;
            if($inc >= count($model->goods)){
                echo \yii\helpers\Html::endTag('tbody');
            }

            ?>
        <? endforeach; ?>

        <tr class="btn-buy-group">
            <td colspan="2">
                <? if(count($model->goods) > $products_count): ?>
                <button class="btn btn-touchspin btn-product-collapse" type="button" data-toggle="collapse" data-target="#product-collapse">
                    + <?=Tr::t('catalog-main', 'more') ?>
                      <?=count($model->goods) - $products_count; ?>
                      <?=Tr::t('catalog-main', 'versions') ?>
                </button>
                <? endif; ?>
            </td>
            <td colspan="1">
                <div><input class="btn btn-touchspin" value="<?= Tr::t('catalog-main', 'BTN_BUY'); ?>" type="submit"></div>
            </td>
            <td colspan="3">

                <? if(count($model->goods) > 1): ?>
                    <?=
                    \app\modules\catalog\widgets\cart\UpdateCountAll::widget(['dataTarget' => '.form-buy-group']);
                    ?>
                <? endif; ?>
            </td>
        </tr>
    </table>


</form>
