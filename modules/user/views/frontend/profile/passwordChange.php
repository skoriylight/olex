<?php

use yii\bootstrap\ActiveForm;
use app\modules\user\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\user\forms\frontend\PasswordChangeForm */

$this->title = Module::t('module', 'TITLE_PASSWORD_CHANGE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'TITLE_PROFILE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$fieldConfig = [
    'options' => ['class' => 'row form-group order-form-group'],
    'template' => "{label}\n<div class='col-sm-10'>{input}</div>\n{error}",
    'labelOptions' => ['class' => 'control-label col-sm-2 '],
    'errorOptions' => ['class' => 'col-sm-8 col-sm-offset-2 help-block help-block-error'],
];
?>
<div class="user-profile-password-change user-profile-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <div class="user-form">

        <?php $form = ActiveForm::begin(
                [
                        'id' => 'password-change-form',
                    'fieldConfig' => $fieldConfig,
                ]); ?>

        <?= $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton(Module::t('module', 'BUTTON_SAVE'), ['class' => 'btn btn-save', 'name' => 'change-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
