<?php

namespace app\modules\catalog\widgets\frontend;

use app\modules\main\components\Tr;
use app\modules\property\widgets\frontend\PropertyTable;
use yii\base\Widget;
use yii\bootstrap\Tabs;
use yii\helpers\Html;

Class ViewTabs extends Widget
{


    public $model;

    public function run()
    {


        return Tabs::widget([
            'items' => [
                [
                    'label' => Tr::t('catalog-main', 'TAB_PROPERTIES'),
                    'content' => PropertyTable::widget(['model' => $this->model]),
                    'active' => true
                ],
                [
                    'label' => Tr::t('catalog-main', 'TAB_CONTENT'),
                    'content' =>Html::encode($this->model->content),

                ],
                [
                    'label' => Tr::t('catalog-main', 'TAB_COMMENTS'),
                    'content' => \yii2mod\comments\widgets\Comment::widget([
                        'model' => $this->model,
                    ]),

                ],


            ],
            'options' => [
                'class' => 'view-tabs'
            ],
            'tabContentOptions' => [
                'class' => 'view-content-tabs'
            ]
        ]);
    }
}