<?php
use yii\widgets\ActiveForm;

\yii\bootstrap\Modal::begin([
    'header' => '<h2>Добавление свойства</h2>',
    'id' => 'modal-create-property',
    'toggleButton' => false,
]);




$form = ActiveForm::begin([
    'action' => ['create'],

    'enableAjaxValidation' => false,
    'validateOnChange' => true,


    'options' => [
        'enctype' => 'multipart/form-data',
        'id' => 'create-property'
    ]
]); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'groups_ids')->checkboxList(\app\modules\property\models\Object::geGroupList()) ?>
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
