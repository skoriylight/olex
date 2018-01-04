<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\catalog\forms\backend\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('catalog-admin', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'pjax' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['width' => '50px'],
                ],

            'firstImage' => [
                'contentOptions' => ['width' => '70px'],
                'format' => 'raw',
                'value' => function($m){
                    $url = \Yii::$app->imageresize->getUrl(trim($m->firstImage, '/'), 70, 70);
                     return  Html::img($url);
                    }
            ],
            'name',
            'title',
            'price',

            // 'description',
            // 'content:ntext',
            // 'position',
            // 'parent_id',
            // 'article',
            // 'create_at',
            // 'update_at',
            // 'category_id',
            // 'color',
            ['class' => \yii\grid\ActionColumn::className(),
                'template' => '{update} {delete}',
                'contentOptions' => ['width' => '50px'],
            ],

        ],


        'toolbar' => [
            ['content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', \yii\helpers\Url::to(['create']), ['type' => 'button', 'title' => 'Добавить товар', 'class' => 'btn btn-success']) . ' ' .
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
            ],
            '{export}',
            '{toggleData}',
        ],
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],

        'bordered' => 1,
        'condensed' => 1,
        'hover' => 1,
        // 'showPageSummary' => 1,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => $this->title,
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        'itemLabelSingle' => $this->title,
        'itemLabelPlural' => $this->title


    ]); ?>
</div>
