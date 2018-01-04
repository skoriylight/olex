<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\forms\backend\search\CategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'parent_id') ?>

    <?php // echo $form->field($model, 'tree_id') ?>

    <?php // echo $form->field($model, 'lft') ?>

    <?php // echo $form->field($model, 'rgt') ?>

    <?php // echo $form->field($model, 'depth') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('catalog', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('catalog', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
