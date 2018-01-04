<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\order\forms\backend\OrderPaymentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-payment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'payment_type_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('order', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('order', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
