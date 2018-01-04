<?php

use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
use kartik\helpers\Html;
use kartik\popover\PopoverX;
use kartik\color\ColorInput;

$this->title = 'Редактировать список значений';

$this->params['breadcrumbs'][] = ['label' => 'Редактировать свойства', 'url' => ['index']];
$this->params['breadcrumbs'][] = $modelProperty->name;
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin();

$attribs = [];
$attribs['attributes']['file'] = [
    'type' => TabularForm::INPUT_RAW,
    //'columnOptions'=>['hAlign'=>\kartik\grid\GridView::ALIGN_MIDDLE],
    'value' => function ($m, $k, $i, $w) {
        return "<div class='upload-kit-xs'>".\trntv\filekit\widget\Upload::widget(
                [
                    'model' => $m,
                    'attribute' => "[{$k}]file",
                    'multiple' => false,
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
$attribs['attributes']['alias'] = [];




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
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete-value', 'id' => $model->id], ['data-confirm'=>"Вы действительно хотите удалить данную запись?"]);
            }
        ]
    ],
    'gridSettings' => [

        'floatHeader' => false,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> '.$this->title.'</h3>',
            'type' => \kartik\grid\GridView::TYPE_PRIMARY,
            'after' => Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить', '#',
                    ['class' => 'btn btn-success', 'data-toggle'=>"modal", 'data-target'=>"#modal-create-property"]) . ' ' .
                //Html::a('<i class="glyphicon glyphicon-remove"></i> Delete', '#', ['class' => 'btn btn-danger']) . ' ' .
                Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Save', ['class' => 'btn btn-primary'])
        ]
    ]
]);
ActiveForm::end();

echo $this->render('value-create-form', ['model' => $newModel]);
?>