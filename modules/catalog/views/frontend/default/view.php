<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\backend\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['category_container'] = 'true';


?>
<div class="catalog-view">




  <?=\app\modules\catalog\widgets\frontend\ProductInfoBlock::widget(['model' => $model]) ?>
    <div class="margin-block"></div>
    <?=\app\modules\catalog\widgets\frontend\ViewTabs::widget(['model' => $model])  ?>

</div>

