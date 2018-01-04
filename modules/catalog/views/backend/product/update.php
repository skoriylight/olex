<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\backend\Product */

$this->title = Yii::t('catalog', 'Update {modelClass}: ', [
    'modelClass' => 'Product',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
$this->params['breadcrumbs'][] = Yii::t('catalog', 'Update');
?>
<div class="product-update">



    <?= $this->render('_form', [
        'model' => $model,

    ]) ?>

</div>
