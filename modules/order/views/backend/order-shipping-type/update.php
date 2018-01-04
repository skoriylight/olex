<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\order\models\OrderShippingType */

$this->title = Yii::t('order', 'Update {modelClass}: ', [
    'modelClass' => 'Order Shipping Type',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('order', 'Order Shipping Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('order', 'Update');
?>
<div class="order-shipping-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
