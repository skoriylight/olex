<?php

use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
use kartik\helpers\Html;
use kartik\popover\PopoverX;
use kartik\color\ColorInput;

$this->title = Yii::t('catalog', 'Goods');
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelProduct->name, 'url' => ['update', 'id' => $modelProduct->id]];
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin();
//$attribs = $model->formAttribs;
//unset($attribs['attributes']['color']);
$attribs = [];
$attribs['attributes']['img'] = [
    'type' => TabularForm::INPUT_RAW,
    //'columnOptions'=>['hAlign'=>\kartik\grid\GridView::ALIGN_MIDDLE],
    'value' => function ($m, $k, $i, $w) {
        return "<div class='upload-kit-xs'>".\trntv\filekit\widget\Upload::widget(
                [
                    'model' => $m,
                    'attribute' => "[{$k}]img",

                    'multiple' => false,
                    //'name' => "[{$k}]img",
                    'url' => ['upload'],
                    'sortable' => false,
                    'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
                    'maxNumberOfFiles' => 1,
                    //'clientOptions' => [ ...other blueimp options... ]
                ]
            ).'</div>';
    }
];
$attribs['attributes']['name'] = [];
$attribs['attributes']['prices'] = [
    'type' => TabularForm::INPUT_RAW,
    'columnOptions'=>['hAlign'=>\kartik\grid\GridView::ALIGN_MIDDLE],
    'value' => function ($m, $k, $i, $w) {
        $content = \app\modules\catalog\widgets\backend\PriceForm::widget([
            'model' => $m,
            'attribute' => 'price_idx',
            'index' => $k
        ]);
        return PopoverX::widget([
            'header' => 'Prices',
            'id' => 'price-modal'.$m->id,
            'placement' => PopoverX::ALIGN_RIGHT,
            'content' => $content,
            'footer' => Html::button('ok', ['class'=>'btn btn-sm btn-primary', 'dialog-role' => 'price-modal'.$m->id]),
            'toggleButton' => ['label'=>'Prices', 'class'=>'btn btn-primary'],
            'size' => PopoverX::SIZE_LARGE,
        ]);
    }
];

$attribs['attributes']['color'] = [
    'type'=>TabularForm::INPUT_WIDGET,
    'columnOptions'=>['hAlign'=>\kartik\grid\GridView::ALIGN_MIDDLE],
    'widgetClass'=> ColorInput::classname(),
    'options'=>[
        'showDefaultPalette'=>false,
        'pluginOptions'=>[
            'preferredFormat'=>'name',
            'palette'=>[
                [
                    "white", "black", "grey", "silver", "gold", "brown",
                ],
                [
                    "red", "orange", "yellow", "indigo", "maroon", "pink"
                ],
                [
                    "blue", "green", "violet", "cyan", "magenta", "purple",
                ],
            ]
        ]
    ],

];


echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'form' => $form,
    'attributes' => $attribs['attributes'],
    'actionColumn' =>     [
        'class' => '\kartik\grid\ActionColumn',
        'updateOptions' => ['style' => 'display:none;'],
        'width' => '60px',
        'template'=>' {delete}',
        'buttons' => [
            'delete' => function($url, $model){
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['goods-delete', 'id' => $model->id], ['data-confirm'=>"Вы действительно хотите удалить данную запись?"]);
            }
        ]
    ],
    'gridSettings' => [

        'floatHeader' => false,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> '.Html::encode($this->title).'</h3>',
            'type' => \kartik\grid\GridView::TYPE_PRIMARY,
            'after' => Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить', '#',
                    ['class' => 'btn btn-success', 'data-toggle'=>"modal", 'data-target'=>"#modal-create-goods"]) . ' ' .
                //Html::a('<i class="glyphicon glyphicon-remove"></i> Delete', '#', ['class' => 'btn btn-danger']) . ' ' .
                Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Save', ['class' => 'btn btn-primary'])
        ]
    ]
]);
ActiveForm::end();
?>
<?=$this->render('goods-create-form', ['model' => $newModel]) ?>
<?
$this->registerJs("
$(document).on('click', '[dialog-role]', function(){
let selector = $(this).attr('dialog-role');

$('#'+selector).popoverX('hide');
})
");