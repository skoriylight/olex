<?php

use app\modules\catalog\widgets\frontend\ProductView;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;



?>


    <?
    $items = [];
    foreach($model as $item): ?>
        <?
        $items[] =  ProductView::widget([
            'model' => $item,
            'view' => ProductView::BLOCK_VIEW_ADAPT,
            'buy_block' => false
        ]);
        ?>
    <? endforeach; ?>
<div class="attr-container flex-inline flex-vertical-center">
    <a class="attr-label <?=$label_class ?>" href="<?=$url ?>">
        <div class="attr-icon <?=$label_class ?>">
            <?=$label_mark_icon ?>
        </div>
        <?=$label_mark_label ?>
    </a>
    <div class="attr-line <?=$label_class ?>"></div>
    <a class="attr-href <?=$label_class ?>" href="<?=$url ?>" >посмотреть все</a>
</div>
<?=Slick::widget([

    // HTML tag for container. Div is default.
    'itemContainer' => 'div',
    'containerOptions' => ['class' => ''],

    'jsPosition' => yii\web\View::POS_READY,

    'items' => $items,

    'itemOptions' => ['class' => 'cat-image'],
    'clientOptions' => [
        'autoplay' => false,
        //'dots'     => true,
        'slidesToShow' => 5,
        'slidesToScroll' => 5,
        // note, that for params passing function you should use JsExpression object
        // but pay atention, In slick 1.4, callback methods have been deprecated and replaced with events.
        'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),

        'responsive' => [
            [
                'breakpoint'=> 768,
                'settings'=> [
                    'arrows'=> true,
                    'centerMode'=> true,
                    'centerPadding'=> 40,
                    'slidesToShow'=> 5,
                    'slidesToScroll' => 5,
                ]
            ]
        ],
    ],

]); ?>

