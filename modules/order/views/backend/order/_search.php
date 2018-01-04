<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\order\forms\backend\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'client_name') ?>

    <?= $form->field($model, 'client_phone') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'client_city') ?>

    <?php // echo $form->field($model, 'promocode') ?>

    <?php // echo $form->field($model, 'reciver_name') ?>

    <?php // echo $form->field($model, 'reciver_phone') ?>

    <?php // echo $form->field($model, 'reciver_city') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'base_cost') ?>

    <?php // echo $form->field($model, 'payment_type_id') ?>

    <?php // echo $form->field($model, 'shipping_type_id') ?>

    <?php // echo $form->field($model, 'delivery_time_date') ?>

    <?php // echo $form->field($model, 'delivery_time_hour') ?>

    <?php // echo $form->field($model, 'delivery_time_min') ?>

    <?php // echo $form->field($model, 'delivery_type') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'order_info') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'seller_user_id') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'payment') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'address') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('order', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('order', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
