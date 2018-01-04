<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Настройки';

$this->params['breadcrumbs'][] = $this->title;
?>


<div class="settings-default-index">

    <?php $form = ActiveForm::begin(['id' => 'site-settings-form']); ?>
    <?= $form->field($model, 'siteName') ?>
    <?= $form->field($model, 'siteDescription') ?>
    <div class="form-group">
        <?= Html::submitButton( 'Сохранить', [
            'class' => 'btn btn-primary',
            'name' => 'submit-button',
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
