<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\order\models\OrderShippingType */

$this->title = Yii::t('order', 'Create Order Shipping Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('order', 'Order Shipping Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-shipping-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
