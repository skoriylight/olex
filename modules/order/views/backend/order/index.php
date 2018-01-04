<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\order\forms\backend\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('order', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?//= Html::a(Yii::t('order', 'Create Order'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'client_name',
            'client_phone',
            'email:email',
            'client_city',
            // 'promocode',
            // 'reciver_name',
            // 'reciver_phone',
            // 'reciver_city',
            // 'cost',
            // 'base_cost',
            // 'payment_type_id',
            // 'shipping_type_id',
            // 'delivery_time_date',
            // 'delivery_time_hour:datetime',
            // 'delivery_time_min:datetime',
            // 'delivery_type',
            // 'status',
            // 'order_info:ntext',
            // 'time',
            // 'user_id',
            // 'seller_user_id',
            // 'date',
            // 'payment',
            // 'timestamp:datetime',
            // 'comment:ntext',
            // 'address',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
                ],
        ],
    ]); ?>
</div>
