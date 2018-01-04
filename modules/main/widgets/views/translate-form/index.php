<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$fields = [];
$fields['origin'] = '';
/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<? foreach ($modelArr as $attribute => $languages): ?>
    <? $fields['origin'].=$this->context->getTypeField($model, $attribute); ?>
    <? foreach ($languages as $language => $value): ?>
        <?
        if (!isset($fields[$language])) {
            $fields[$language] = '';
        }
        $fields[$language] .= $this->context->getTypeField($model, $attribute, $language);
        ?>
    <? endforeach; ?>

<? endforeach; ?>


<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#panel-origin">Origin</a></li>
    <? foreach ($model->languages as $tab): ?>
            <li class=""><a data-toggle="tab" href="#panel-<?= $tab ?>"><?= $tab ?></a></li>
    <? endforeach; ?>
</ul>

<div class="tab-content">
    <div id="panel-origin" class="tab-pane fade in active">
        <div class="panel panel-default">
            <div class="panel-body">
        <?= $fields['origin'] ?>
            </div>
        </div>
    </div>
    <? foreach ($model->languages as $tab): ?>
        <div id="panel-<?= $tab ?>" class="tab-pane fade">
            <div class="panel panel-default">
                <div class="panel-body">
            <?= $fields[$tab] ?>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>
