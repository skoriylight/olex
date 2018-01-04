<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\backend\Product */

$this->title = Yii::t('catalog', 'Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsGoods' =>  $modelsGoods
    ]) ?>

</div>
