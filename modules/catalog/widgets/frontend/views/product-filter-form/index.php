<?php

use app\modules\main\components\Tr;
use kartik\checkbox\CheckboxX;
use kartik\field\FieldRange;
use sjaakp\bandoneon\Bandoneon;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use bookin\aws\checkbox\AwesomeCheckbox;
use kartik\slider\Slider;

$params = isset($_GET['category_slug']) ? ['/catalog/default/index', 'category_slug' => $_GET['category_slug']] : ['/catalog/default/index'];


$url = Url::to($params);
$url_base = Url::to('/catalog/default/index');
$form = ActiveForm::begin([
    'action' => Url::to($params),
    'method' => 'GET',
    'options' => [
        'class' => 'filter-form',
        'id' => 'catalog-filter-form',
        'data-pjax' => ''
    ]
]);
echo Html::tag('h5', Tr::t('catalog', 'FILTER_TITLE'), ['class' => 'filter-title text-center']);
echo Html::tag('hr');
echo Html::beginTag('div');
echo Html::label(Tr::t('catalog', 'FILTER_PRICE_LABEL'));
echo Html::beginTag('div', ['class' => 'form-group price-group flexbox flex-align-between']);
echo Html::tag('span', Tr::t('catalog', 'FROM'));
echo Html::textInput('min-price', $priceValueMin, ['class' => 'price-input', 'id' => 'min-price']);
echo Html::tag('span', Tr::t('catalog', 'TO'));
echo Html::textInput('max-price', $priceValueMax, ['class' => 'price-input', 'id' => 'max-price']);
echo Html::endTag('div');
echo Html::endTag('div');
echo Slider::widget([
    'name' => 'product_price',
    'id' => 'product_price',
    'value' => $price_value,
    'sliderColor' => '#dcdcdc',
    'handleColor' => '#02a709',
    'pluginEvents' => [
        'slideStop' => "function(){
                    var val = $(this).slider('getValue');
                    $('#max-price').val(val[1]);
                     $('#min-price').val(val[0]);
                     
                        
                         $.pjax.reload('#catalog-container', {
                            url: '$url_base?'+$('#mark-filter-form').serialize()+'&'+$('#catalog-filter-form').serialize()
                        });
                    }",
    ],

    'pluginOptions' => [

        'min' => $price_min,
        'max' => $price_max,
        'step' => 1,
        'range' => true,

    ],
]);
echo Html::tag('hr');
echo Html::beginTag('ul');

foreach ($arr as $prop_id => $one) {
    echo Html::beginTag('li');

    echo Html::label($one['name'], '', ['class' => 'faq-heading '.($one['is_open']?'faq-minus':'faq-plus')]);
    echo Html::beginTag('ul', ['class' => 'faq-content', 'style' => ($one['is_open']?'':'display: none')]);
    foreach ($one['items'] as $id => $item) {
        echo Html::beginTag('li');


        echo $form->field($item['model'], "filterValue[$prop_id][$id]")->widget(AwesomeCheckbox::classname(),
            [
                'options' => [
                    'value' => $id,
                    'uncheck' => null,
                    'label' => $item['label']
                ]
            ]

        )->label(false);


        echo Html::endTag('li');
    }
    echo Html::endTag('ul');

    echo Html::endTag('li');

}

echo Html::endTag('ul');
//echo Html::submitButton('filter', ['class' => 'btn btn-green', 'style' => 'width: 100%']);
//echo Html::endForm();
ActiveForm::end();

$js = <<<JS
$('.faq-heading').click(function(){
    var btn = $(this);
    $(this).siblings('.faq-content').toggle('fast', function(){
    if($(this).css('display') == 'none') {
        btn.addClass('faq-plus'); btn.removeClass('faq-minus');
    } else {
        btn.addClass('faq-minus'); btn.removeClass('faq-plus');
    }
    });
});

$(document).on('change', '.faq-content input', function(){
$.pjax.reload('#catalog-container', {
    url: "$url_base?"+$('#mark-filter-form').serialize()+'&'+$('#catalog-filter-form').serialize()
})
})
JS;

$this->registerJS($js);


