<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\order\models\OrderShippingType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-shipping-type-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'free_cost_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?php

    echo   $form->field($model, 'image')->widget(
        '\trntv\filekit\widget\Upload',
        [
            'url' => ['upload'],
            'sortable' => false,
            'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
            'maxNumberOfFiles' => 1,
            //'clientOptions' => [ ...other blueimp options... ]
    ]
);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('order', 'Create') : Yii::t('order', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
