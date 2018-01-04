<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

    <div class="view-bar">
        <?
        $params = isset($_GET['category_slug']) ? ['/catalog/default/index', 'category_slug' => $_GET['category_slug']] : ['/catalog/default/index'];


        $url = Url::to($params);
        ?>
        <? \yii\widgets\ActiveForm::begin(
            [
                'id' => 'mark-filter-form',
                'action' => Url::to($params),
                'method' => 'GET',
                'options' => ['data-pjax' => '']
            ]); ?>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-1"></div>
            <div class="col-md-7 flex-inline flex-align-between">
                <?
                echo \app\modules\attribute\widgets\MarkCheckbox::widget([
                    'model' => $model,
                    'attribute' => 'attr_mark[is_new]',
                    'options' => [
                        'label' => '<div class="attr-icon attr-new">new</div>' . (is_null($count['is_new']) ? 0 : $count['is_new']),
                        'uncheck' => false,
                    ],
                    'labelOptions' => [
                        'class' => 'mark-label'
                    ]
                ]);
                ?>

                <?
                echo \app\modules\attribute\widgets\MarkCheckbox::widget([
                    'model' => $model,
                    'attribute' => 'attr_mark[is_sale]',
                    'options' => [
                        'label' => '<div class="attr-icon attr-sale">sale</div>' . (is_null($count['is_sale']) ? 0 : $count['is_sale']),
                        'uncheck' => false,
                    ],
                    'labelOptions' => [
                        'class' => 'mark-label'
                    ]
                ]);
                ?>
                <?
                echo \app\modules\attribute\widgets\MarkCheckbox::widget([
                    'model' => $model,
                    'attribute' => 'attr_mark[is_hit]',
                    'options' => [
                        'label' => '<div class="attr-icon attr-hit">хит</div>' . (is_null($count['is_hit']) ? 0 : $count['is_hit']),
                        'uncheck' => false,
                    ],
                    'labelOptions' => [
                        'class' => 'mark-label'
                    ]
                ]);
                ?>
                <?
                echo \app\modules\attribute\widgets\MarkCheckbox::widget([
                    'model' => $model,
                    'attribute' => 'attr_mark[is_coming]',
                    'options' => [
                        'label' => '<div class="attr-icon attr-coming"><i class="glyphicon glyphicon-time"></i></div>' . (is_null($count['is_coming']) ? 0 : $count['is_coming']),
                        'uncheck' => false,
                    ],
                    'labelOptions' => [
                        'class' => 'mark-label'
                    ]
                ]);
                ?>
                <?
                echo \app\modules\attribute\widgets\MarkCheckbox::widget([
                    'model' => $model,
                    'attribute' => 'attr_mark[is_stock]',
                    'options' => [
                        'label' => '<div class="attr-icon attr-stock">A</div>' . (is_null($count['is_stock']) ? 0 : $count['is_stock']),
                        'uncheck' => false,
                    ],
                    'labelOptions' => [
                        'class' => 'mark-label'
                    ]
                ]);
                ?>

            </div>
            <div class="col-md-2 text-center">

                <?
                echo \app\modules\catalog\widgets\frontend\BtnToggleView::widget([
                    'tabs' => [
                        \app\modules\catalog\widgets\frontend\ProductView::BLOCK_VIEW_4 =>
                            [
                                'icon' => '',
                                'class' => 'btn-toggle-view glyphicon glyphicon-th'
                            ],
                        \app\modules\catalog\widgets\frontend\ProductView::LIST_PHOTO_VIEW =>
                            [
                                'icon' => '',
                                'class' => 'btn-toggle-view glyphicon glyphicon-th-list'
                            ],
                        \app\modules\catalog\widgets\frontend\ProductView::LIST_VIEW =>
                            [
                                'icon' => '',
                                'class' => 'btn-toggle-view glyphicon glyphicon glyphicon-tasks'
                            ],
                    ]
                ])
                ?>
            </div>
        </div>
        <? \yii\widgets\ActiveForm::end(); ?>
    </div>

<?
$url_base = \yii\helpers\Url::to('/catalog/default/index');
$js = <<<JS
$(function(){
$(document).on('pjax:end', '#catalog-container', function() {
    
        ltcart.cart.renderCart();
    });
});

$(document).on('change', '#mark-filter-form', function(event){

    event.preventDefault();
    $.pjax.reload({
    container: '#catalog-container',
    url: "$url_base?"+$('#mark-filter-form').serialize()+'&'+$('#catalog-filter-form').serialize()
    });
    
});

$(document).on('afterSelect', '[data-role="tab-view"]', function(event){

    event.preventDefault();
    $.pjax.reload({
    container: '#catalog-container',
    url: "$url_base?"+$('#mark-filter-form').serialize()+'&'+$('#catalog-filter-form').serialize()
    });
    
});
JS;

$this->registerJS($js);
?>