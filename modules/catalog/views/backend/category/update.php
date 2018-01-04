<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\Category */

$this->title = !$model->isNewRecord ? Yii::t('catalog', 'Update {modelClass}: ', [
    'modelClass' => 'Category',
]) . $model->name: Yii::t('catalog', 'Create {modelClass} ', [
    'modelClass' => 'Category',
]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Categories'), 'url' => ['index']];

$this->params['breadcrumbs'][] = $model->isNewRecord?Yii::t('catalog', 'Create'): Yii::t('catalog', 'Update');
?>
<div class="category-update">



    <div class="panel panel-primary">
        <div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>



</div>
