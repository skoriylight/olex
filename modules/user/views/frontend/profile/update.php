<?php

use yii\bootstrap\ActiveForm;
use app\modules\user\Module;
use yii\helpers\Html;
use app\modules\main\components\Tr;

/* @var $this yii\web\View */
/* @var $model \app\modules\user\forms\frontend\ProfileUpdateForm */

$this->title = Module::t('module', 'TITLE_PROFILE_UPDATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'TITLE_PROFILE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$fieldConfig = [
    'options' => ['class' => 'row form-group order-form-group'],
    'template' => "{label}\n<div class='col-sm-8'>{input}</div>\n{error}",
    'labelOptions' => ['class' => 'control-label col-sm-4 '],
    'inputOptions' => ['disabled'=>true],
    'errorOptions' => ['class' => 'col-sm-8 col-sm-offset-2 help-block help-block-error'],
];
?>

<div class="user-profile-update">
    <div class="vertical-border"></div>


    <div class="user-form">





        <div class="row">

            <div class="col-md-6">

                <?php \yii\widgets\Pjax::begin();  ?>
                <?php $form = ActiveForm::begin(['id' => 'profile-update-form' ,
                    'options' => ['data-pjax' => ''],
                    'fieldConfig' => $fieldConfig,
                ]); ?>

                <div class="row">
                    <div class="col-xs-8"><h4><?=Tr::t('profile' , 'CONTACT_CUSTOMER_DATA') ?></h4></div>
                    <div class="col-xs-4 text-right">
                        <?= Html::submitButton(Tr::t('main', 'BUTTON_SAVE'),
                            ['class' => 'btn btn-save hidden', 'name' => 'update-button', 'data-role'=> 'btn-profile-save']) ?>
                        <span data-role="btn-profile-edit" class="btn-profile-edit"><?=Tr::t('profile', 'BTN_EDIT') ?></span>
                    </div>
                </div>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>


                <?php ActiveForm::end(); ?>
                <?php \yii\widgets\Pjax::end();  ?>

            </div>
            <div class="col-md-6">

                <?php \yii\widgets\Pjax::begin();  ?>
                <?php $form = ActiveForm::begin(['id' => 'profile-update-form2' ,
                    'options' => ['data-pjax' => ''],
                    'fieldConfig' => $fieldConfig,
                ]); ?>

                <div class="row">
                    <div class="col-xs-8"><h4><?=Tr::t('profile' , 'DATA_FOR_THE_RECIPIENT_OF_GOODS') ?></h4></div>
                    <div class="col-xs-4 text-right">
                        <?= Html::submitButton(Tr::t('main', 'BUTTON_SAVE'),
                            ['class' => 'btn btn-save hidden', 'name' => 'update-button', 'data-role'=> 'btn-profile-save']) ?>
                        <span data-role="btn-profile-edit" class="btn-profile-edit"><?=Tr::t('profile', 'BTN_EDIT') ?></span>
                    </div>
                </div>

                <?= $form->field($model, 'shipping_city')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'shipping_type_id')->dropDownList(\Yii::$app->order->shippingList) ?>

                <?= $form->field($model, 'shipping_dep')->textInput(['maxlength' => true]) ?>



                <?php ActiveForm::end(); ?>


                <?php \yii\widgets\Pjax::end();  ?>

                <?php \yii\widgets\Pjax::begin();  ?>
                <?php $form = ActiveForm::begin(['id' => 'profile-update-form3' ,
                    'options' => ['data-pjax' => ''],
                    'fieldConfig' => $fieldConfig,
                ]); ?>

                <div class="row">
                    <div class="col-xs-8"><h4><?=Tr::t('profile' , 'CONTACT_CUSTOMER_RECIPIENT') ?></h4></div>
                    <div class="col-xs-4 text-right">
                        <?= Html::submitButton(Tr::t('main', 'BUTTON_SAVE'),
                            ['class' => 'btn btn-save hidden', 'name' => 'update-button', 'data-role'=> 'btn-profile-save']) ?>
                        <span data-role="btn-profile-edit" class="btn-profile-edit"><?=Tr::t('profile', 'BTN_EDIT') ?></span>
                    </div>
                </div>

                <?= $form->field($model, 'recipient_full_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'recipient_phone')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'recipient_city')->textInput(['maxlength' => true]) ?>





                <?php ActiveForm::end(); ?>
                <?php \yii\widgets\Pjax::end();  ?>

            </div>
        </div>

    </div>

</div>

<?
$js = <<<JS
$(document).on('click', "[data-role='btn-profile-edit']", function(){
    $(this).siblings("[data-role='btn-profile-save']").removeClass('hidden');
    $(this).addClass('hidden');
    $(this).closest('form').find('input, select').attr('disabled', false);
});
JS;

$this->registerJS($js);

?>
