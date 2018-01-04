<?
use app\modules\main\components\Tr;

?>



<div class="row form-group order-form-group">
    <div class="col-md-3">
        <?=\yii\helpers\Html::label(Tr::t('order', 'DELIVERY_CITY'), null, ['class' => 'control-label']); ?>
    </div>
    <div class="col-md-9">
        <?= \yii\helpers\Html::activeTextInput(\Yii::$app->order->getOrder(), "options[delivery_city][$idx]",
            [
                'class' => 'form-control'
            ]
        ) ?>
    </div>
</div>

<div class="row form-group order-form-group">
    <div class="col-md-3">
        <?=\yii\helpers\Html::label(Tr::t('order', 'DELIVERY_DEP'), null, ['class' => 'control-label']); ?>
    </div>
    <div class="col-md-9">
        <?= \yii\helpers\Html::activeTextInput(\Yii::$app->order->getOrder(), "options[delivery_department][$idx]",
            [

                    'class' => 'form-control'

            ]
        ) ?>
    </div>
</div>