<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\order\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client_city')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'reciver_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reciver_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reciver_city')->textInput(['maxlength' => true]) ?>






    <?= $form->field($model, 'shipping_type_id')->textInput() ?>




    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>





    <?= $form->field($model, 'payment')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>


    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('order', 'Create') : Yii::t('order', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
