<?

use app\modules\catalog\widgets\cart\CartTable;
use app\modules\favorite\widgets\CartTable as FavoriteTable;
use app\modules\main\components\Tr;

?>



<?php
$f = function ($class){
    $res = '<span  data-model="'.$class.'" data-role="favorite-count-btn">';
    $res.=isset(\Yii::$app->favorite->count[$class])?\Yii::$app->favorite->count[$class]:0;
    return $res.'</span>';
};

echo \yii\widgets\Menu::widget([
        'encodeLabels' => false,
    'items' => [
        ['label' => Tr::t('main-cart' , 'CART_TAB').' '.\dvizh\cart\widgets\CartInformer::widget(['htmlTag' => 'span', 'offerUrl' => '', 'text' => '{c}']), 'url' => ['/catalog/cart/index']],
        ['label' => Tr::t('main-cart' , 'FAVORITE_TAB').' '.$f(\app\modules\goods\models\Goods::className()), 'url' => ['/catalog/cart/index','view' => 'favorite']],
        ['label' => Tr::t('main-cart' , 'COMING_TAB'), 'url' => ['/catalog/cart/index','view' => 'coming']],
        ['label' => Tr::t('main-cart' , 'CART_HISTORY_TAB').' '.$f(\app\modules\goods\models\GoodsHistory::className()), 'url' => ['/catalog/cart/index','view' => 'history']],
    ],
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'col-md-3'
    ],
    'options' => [
        'tag' => 'div',
        'class' => 'row'
    ],
    'linkTemplate' => '<a class="attr-label attr-green attr-block" href="{url}"><div class="attr-icon attr-green"></div>{label}</a>',
]);
?>
<div class="margin-block"></div>
<?php

if ($view == 'index') {
    echo CartTable::widget();
     echo \yii\helpers\Html::a(Tr::t('main-cart', 'CHECKOUT'), ['/order/default/index'], ['class' => 'btn btn-save']);


} elseif ($view == 'favorite') {
    echo FavoriteTable::widget(
        [
            'view' => 'favorite-tab',
            'model' => isset(\Yii::$app->favorite->elements[\app\modules\goods\models\Goods::className()])?\Yii::$app->favorite->elements[\app\modules\goods\models\Goods::className()]:[],
            'modelName' => \app\modules\goods\models\Goods::className()
        ]);
} elseif ($view == 'history') {
    echo FavoriteTable::widget(
        [
            'view' => 'favorite-tab',
            'model' => isset(\Yii::$app->favorite->elements[\app\modules\goods\models\GoodsHistory::className()])?\Yii::$app->favorite->elements[\app\modules\goods\models\GoodsHistory::className()]:[],
         'modelName' => \app\modules\goods\models\GoodsHistory::className()
        ]);
}

?>
