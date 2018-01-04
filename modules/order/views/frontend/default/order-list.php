<?php
use app\modules\main\components\Tr;
?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'class' => 'order-table'
    ],
    'summary' => false,
    'tableOptions' => [
        'class' => 'table'
    ],
    'rowOptions' => [
        'options' => [

        ],
'class' => 'text-center'
    ],

    'columns' => [
        'id' => [
            'value' => function($model){
                return '№'.$model['id'];
            },
            'header' => Tr::t('order-main' , 'ORDER_NUMBER')
        ],
        'timestamp' => [
            'value' => function($m){

                return Yii::$app->formatter->asDate($m['timestamp'], 'php:Y-m-d');
            },
            'header' => Tr::t('order-main' , 'TIMESTAMP')
        ],
        'cost' => [
            'header' => Tr::t('order-main' , 'COST'),
            'value' => function($model){
                return $model['cost'];
            },

        ],
        'payment' => [
            'header' => Tr::t('order-main' , 'PAYMENT'),
            'value' => function($model){
                return $model['payment'];
            },
        ],
        'status' => [
            'header' => Tr::t('order-main' , 'STATUS'),
            'value' => function($model){
                return $model['status'];
            },
        ],


      //  ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>