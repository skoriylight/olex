<?php
use yii\widgets\ActiveForm;
use \yii\helpers\Html;
use yii\widgets\MaskedInput;
use app\modules\main\components\Tr;

?>


<div class="order-create row">
    <div class="col-sm-8 col-sm-offset-2">
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>


        <div class="row">
            <div class="col-xs-6 col-xs-offset-3 text-left flex-inline flex-align-between flex-vertical-center">
                <a class="small-mark-group big-mark-group" href="<?= \yii\helpers\Url::to(['/catalog/cart']) ?>">
                    <div class="small-mark-icon icon-bag active"></div>
                    <div class="small-mark-label">
                        <?= \dvizh\cart\widgets\CartInformer::widget(['htmlTag' => 'span', 'offerUrl' => '', 'text' => '{c}']); ?>
                    </div>
                    шт.
                    <?= \dvizh\cart\widgets\CartInformer::widget(['htmlTag' => 'span', 'cssClass' => 'bottom-mark-label', 'offerUrl' => '', 'text' => 'на {p}']); ?>
                </a>

                <?= Html::a(Tr::t('catalog', 'GO_TO_CART') . '' . Html::img('/images/bag_button.png') . '' .
                    \dvizh\cart\widgets\CartInformer::widget(['htmlTag' => 'span', 'offerUrl' => '', 'text' => '{c}']),
                    ['/catalog/cart'],
                    ['class' => 'btn btn-green']
                ) ?>
            </div>
        </div>

        <div class="user-form">

            <?php $form = ActiveForm::begin(
                [
                    //'layout' => 'horizontal',
                    // 'options' => ['class' => 'form-horizontal'],
                    'id' => 'order-form',

                    'fieldConfig' => [
                        'options' => ['class' => 'row form-group order-form-group'],
                        'template' => "{label}\n<div class='col-sm-8'>{input}</div>\n{error}",
                        'labelOptions' => ['class' => 'control-label col-sm-2 col-sm-offset-1'],
                        'errorOptions' => ['class' => 'col-sm-8 col-sm-offset-3 help-block help-block-error'],
                        //'inputOptions' => ['class' => 'col-sm-3',]
                    ],
                ]
            ); ?>

            <h3>
                <div class="order-label-mark">1</div><?= Tr::t('order-main', 'CUSTOMER_INFORMATION') ?></h3>

            <?= $form->field($model, 'client_name')->textInput(['maxlength' => true]) ?>



            <?= $form->field($model, 'client_phone')->widget(MaskedInput::className(), [
                'mask' => '+38(099)-999-99-99',
            ]) ?>

            <?= $form->field($model, 'client_city')->textInput(['maxlength' => true]) ?>

            <h3>
                <div class="order-label-mark">2</div><?= Tr::t('order-main', 'RECIPIENT_INFORMATION') ?></h3>

            <?= $form->field($model, 'reciver_name')->textInput(['maxlength' => true]) ?>



            <?= $form->field($model, 'reciver_phone')->widget(MaskedInput::className(), [
                'mask' => '+38(099)-999-99-99',
            ]) ?>

            <?= $form->field($model, 'reciver_city')->textInput(['maxlength' => true]) ?>

            <h3>
                <div class="order-label-mark">3</div><?= Tr::t('order-main', 'DELIVERY') ?></h3>


            <?= $form->field($model, 'shipping_type_id',
                 [
                    'template' => "<div class='col-sm-12'>{input}</div>\n{error}",

                    'errorOptions' => ['class' => 'col-sm-8 col-sm-offset-3 help-block help-block-error'],
                ]
            )->widget(\app\modules\order\widgets\ShippingList::className())->label(' ') ?>


            <h3>
                <div class="order-label-mark">4</div><?= Tr::t('order-main', 'COMMENTS') ?></h3>

            <?= $form->field($model, 'comment')->textarea(['maxlength' => true])->label(' ') ?>

            <div class="form-group text-center">
                <?= Html::submitButton(\app\modules\main\components\Tr::t('order', 'CHECKOUT'), ['class' => 'btn btn-checkout btn-lg', 'name' => 'update-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>


</div>
