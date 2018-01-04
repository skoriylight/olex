<?php
use yii\widgets\ActiveForm;

\yii\bootstrap\Modal::begin([
    'header' => '<h2>Новый вариант товара</h2>',
    'id' => 'modal-create-goods',
    'toggleButton' => false,
]);




$form = ActiveForm::begin([
    'action' => ['goods-create', 'id' => $model->product_id],
    'enableClientValidation' => false,
    'enableAjaxValidation' => false,
    'validateOnChange' => true,
    'validateOnBlur' => false,

    'options' => [
        'enctype' => 'multipart/form-data',
        'id' => 'create-goods'
    ]
]); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?php
echo \trntv\filekit\widget\Upload::widget(
    [
        'model' => $model,
        'attribute' => "img",
        'multiple' => false,
        'url' => ['upload'],
        'sortable' => false,
        'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
        'maxNumberOfFiles' => 1,
        //'clientOptions' => [ ...other blueimp options... ]
    ]);

echo \app\modules\catalog\widgets\backend\PriceForm::widget([
    'model' => $model,
    'attribute' => 'price_idx',
    'index' => 0
]);
?>
<div class="form-group">
    <?php
echo \kartik\color\ColorInput::widget([
    'model' => $model,
    'attribute' => "color",
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
])

?>
</div>
<div class="form-group">
<?php
echo \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);
?>
</div>
<?php
ActiveForm::end();
\yii\bootstrap\Modal::end();
?>
