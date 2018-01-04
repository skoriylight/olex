<?php
use yii\widgets\ActiveForm;

\yii\bootstrap\Modal::begin([
    'header' => '<h2>Добавить значение</h2>',
    'id' => 'modal-create-property',
    'toggleButton' => false,
]);




$form = ActiveForm::begin([
    'action' => ['create-value', 'id' => $model->object_id],

    'enableAjaxValidation' => false,
    'validateOnChange' => true,


    'options' => [
        'enctype' => 'multipart/form-data',
        'id' => 'create-property-value'
    ]
]); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>


<?php
echo \trntv\filekit\widget\Upload::widget(
    [
        'model' => $model,
        'attribute' => "file",
        'multiple' => false,
        'url' => ['upload'],
        'sortable' => false,
        'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
        'maxNumberOfFiles' => 1,
    ]);

?>

<div class="form-group">
<?php
echo \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);
?>
</div>
<?php
ActiveForm::end();
\yii\bootstrap\Modal::end();
?>
