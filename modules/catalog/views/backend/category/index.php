<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\modules\catalog\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\catalog\forms\search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('catalog', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    echo \app\modules\catalog\widgets\CategoryTree::widget(['model' => $model]);

    ?>
</div>



