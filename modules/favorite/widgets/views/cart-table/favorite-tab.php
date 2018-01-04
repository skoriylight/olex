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
    'relationModel' => 'getItemModel',
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
        $url = \Yii::$app->imageresize->getUrl(trim($data->item->image,'/'), 100, 100);
        $img =  \yii\helpers\Html::img($url,  [ 'title' => $data->item->name]);
        return \yii\helpers\Html::tag('div'  , $img, ['class' => 'cart-thumb']);

            }
        ],
        'name' => [
            'format' => 'html',
            'label' => Tr::t('cart-main' , 'ITEM_NAME'),
            'content' => function ($data) {
                return "<h4 class='cart-title'>".\yii\helpers\Html::a($data->item->label, ['/catalog/default/view', 'product_slug' => $data->item->product->slug])."</h4>";
            }
        ],
        'price' => [
            'content' => function($data){
                return Html::tag('span', "$ {$data->item->price}" , ['class' => 'cart-price']);
            },
            'format' => 'html',
            'label' => Tr::t('cart-main', 'CART_PRICE')
        ],
        'count' => [
            'format' => 'html', // Возможные варианты: raw, html
            'label' => Tr::t('cart-main' , 'CART_COUNT'),
            'content' => function ($data) {
                $res = '<form id="form_item_'.$data->item_id.'" data-role="cart-buy-form" action="/catalog/cart/add-elements" data-title="'.$data->getItemModel()->product->title.'">';
                $res.= \kartik\touchspin\TouchSpin::widget([
                    'name' => "prod[{$data->item_id}]",
                    'options' => [
                        'class' => 'price-inc',

                        'data-id' => $data->item_id,
                        'data-url' => \yii\helpers\Url::toRoute(['/catalog/cart/update-count']),
                    ],
                    'pluginOptions' => [
                        'initval' => 1,
                        'min' => 1,
                        //'max' => 100,
                        'step' => 1,
                        'decimals' => 0,
                        'buttonup_txt' => '<i class="glyphicon glyphicon-plus"></i>',
                        'buttondown_txt' => '<i class="glyphicon glyphicon-minus"></i>'

                    ],
                ]);
                return $res.'</form>';
            },
        ],




        'add_to_cart' => [
            'content' => function($data){
                return Html::a(Tr::t('cart-main', 'ADD_TO_CART'), '#',[
                    'class' => 'btn btn-to-cart',
                    'onclick' => "$('#form_item_$data->item_id').submit(); return false;"
                ]);
            }
        ],
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

                    return \app\modules\favorite\widgets\BtnDelete::widget(['model' => $model->getItem()->one()]);
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

jQuery(document).on(\'after_delete\', ltfavorite.favorite.delBtn, function (event, json){
           
            $.pjax.reload(\'#cart-pjax\');

        });


');



?>