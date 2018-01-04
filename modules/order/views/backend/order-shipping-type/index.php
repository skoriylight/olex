<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\order\forms\backend\OrderShippingTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('order', 'Order Shipping Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-shipping-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('order', 'Create Order Shipping Type'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'cost',
            'free_cost_from',
            // 'order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
