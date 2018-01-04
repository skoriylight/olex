<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\order\models\OrderPayment */

$this->title = Yii::t('order', 'Create Order Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('order', 'Order Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
