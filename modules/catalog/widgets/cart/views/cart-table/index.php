<?
use yii\grid\GridView;
use \yii\widgets\Pjax;
use app\modules\main\components\Tr;
use yii\helpers\Html;

?>


<? Pjax::begin([
    'id' => 'cart-pjax',
]); ?>
<?= \app\modules\catalog\components\CartGridView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'class' => 'cart-table-container'
    ],
    'tableOptions' => [
        'class' => 'table cart-table'
    ],

    'columns' => [
        // ['class' => 'yii\grid\SerialColumn'],

        'thumb' => [
            'format' => 'html',
            'label' => Tr::t('cart-main' , 'CART_IMAGE'),
            'content' => function($data){
        $url = \Yii::$app->imageresize->getUrl(trim($data->getModel()->image,'/'), 100, 100);
        $img =  \yii\helpers\Html::img($url,  [ 'title' => $data->name]);
        return \yii\helpers\Html::tag('div'  , $img, ['class' => 'cart-thumb']);

            }
        ],
        'name' => [
            'format' => 'html',
            'label' => Tr::t('cart-main' , 'ITEM_NAME'),
            'content' => function ($data) {
                return "<h4 class='cart-title'>".\yii\helpers\Html::a($data->name, ['/catalog/default/view', 'product_slug' => $data->getModel()->product->slug])."</h4>";
            }
        ],
        'price' => [
            'content' => function($data){
                return Html::tag('span', "$ $data->price" , ['class' => 'cart-price']);
            },
            'format' => 'html',
            'label' => Tr::t('cart-main', 'CART_PRICE')
        ],
        'count' => [
            'format' => 'html', // Возможные варианты: raw, html
            'label' => Tr::t('cart-main' , 'CART_COUNT'),
            'content' => function ($data) {

                return \kartik\touchspin\TouchSpin::widget([
                    'name' => 't1',
                    'options' => [
                        'class' => 'price-inc',
                        'data-role' => 'cart-count-btn',
                        'data-id' => $data->item_id,
                        'data-url' => \yii\helpers\Url::toRoute(['/catalog/cart/update-count']),
                    ],
                    'pluginOptions' => [
                        'initval' => $data->count,
                        'min' => 1,
                        //'max' => 100,
                        'step' => 1,
                        'decimals' => 0,
                        'buttonup_txt' => '<i class="glyphicon glyphicon-plus"></i>',
                        'buttondown_txt' => '<i class="glyphicon glyphicon-minus"></i>'

                    ],
                ]);
            },
        ],


        'totalPrice' => [
            'content' => function($data){
                $price = $data->count * $data->price;
                $span = "<span data-cart-price-id='$data->item_id'>$price</span>";
                return Html::tag('span', "$ ".$span,
                    [
                        'class' => 'cart-price',

                    ]);
            },
            'format' => 'html',
            'label' => Tr::t('cart-main', 'CART_TOTAL_PRICE')
        ],

        //'name:ntext',
        //'url:ntext',
        //'category_image:ntext',
        // 'created_at',
        // 'updated_at',

        [
            'class' => \app\modules\catalog\components\CartActionColumn::className(),
            'header' => Tr::t('cart-main' , 'CART_REMOVE'),
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url, $model) {

                    return \app\modules\catalog\widgets\cart\DeleteBtn::widget(['model' => $model]);
                }
            ],
        ],
    ],
]);
?>

<?php Pjax::end(); ?>

<?

$this->registerJs('

$(document).on("ltcartCartDelete", function(){

$.pjax.reload(\'#cart-pjax\');
});


');



?>