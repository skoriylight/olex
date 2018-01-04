<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\order\forms\backend\OrderShippingTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-shipping-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'cost') ?>

    <?= $form->field($model, 'free_cost_from') ?>

    <?php // echo $form->field($model, 'order') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('order', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('order', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
