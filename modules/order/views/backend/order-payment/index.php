<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\order\forms\backend\OrderPaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('order', 'Order Payments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-payment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('order', 'Create Order Payment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_id',
            'payment_type_id',
            'user_id',
            'description',
            // 'ip',
            // 'amount',
            // 'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
