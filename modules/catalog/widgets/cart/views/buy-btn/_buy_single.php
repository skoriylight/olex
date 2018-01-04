<?
use app\modules\main\components\Tr;
?>

<div class="prd-btn-buy">
    <div class="btn btn-color-select" >
        <form class="" data-role="cart-buy-form" data-title="<?=$model->name ?>"  action="<?=$url ?>">
        <table class="table-buy-single">
            <tr>
                <td class="single-buy-touchspin">
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
                            'min' => 1,
                            //'max' => 100,
                            'step' => 1,
                            'decimals' => 0,
                            'buttonup_txt' => '<i class="glyphicon glyphicon-plus"></i>',
                            'buttondown_txt' => '<i class="glyphicon glyphicon-minus"></i>',
                            'verticalbuttons' => false,

                        ],
                    ]);
                    ?>
                </td>
                <td><button class="btn-clear"><?=Tr::t('catalog-main' , 'BTN_BUY'); ?></button></td>
                <td>
                    <div>
                        <label data-cart-count-icon-id="<?=$child->id ?>" class="goods-bag-count">
                            <span class="icon-bag-grey">

                            </span>0
                        </label>
                    </div>


                </td>
            </tr>
        </table>
        </form>
    </div>


</div>