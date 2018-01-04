<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\order\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('order', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('order', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('order', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('order', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'client_name',
            'client_phone',
            'email:email',
            'client_city',
            'promocode',
            'reciver_name',
            'reciver_phone',
            'reciver_city',
            'cost',
            'base_cost',
            'payment_type_id',

            'shipping_type_id',
            'status',

            'time',
            'user_id',
            'seller_user_id',
            'date',
            'payment',
            'timestamp:datetime',
            'comment:ntext',
            'address',
        ],
    ]) ?>

    <h3>Товары</h3>


    <?= \yii\grid\GridView::widget([
        'dataProvider' => $model->getElementsProvider($model->id),
        'filterModel' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'name' => [
                    'header' => 'Товар',
                    'format' => 'raw',
                    'value' => function($m){
                        return Html::a($m->modelElement->label,
                            ['/catalog/default/view', 'product_slug' => $m->modelElement->product->slug], ['target' => '_blank']);
                    }
            ],
            'count' => [
                'header' => 'К-во',
                'value' => function($m){
                    return $m->count;
                }
            ],
            'price' => [
                'header' => 'Цена',
                'value' => function($m){
                    return $m->price;
                }
            ]


        ],
    ]); ?>


</div>
