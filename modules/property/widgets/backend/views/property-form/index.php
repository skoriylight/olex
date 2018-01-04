<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="panel panel-primary">
    <div class="panel-heading">Свойства</div>
    <div class="panel-body">
        <?
        foreach ($value as $objectIndex => $object) {
            //foreach ($object as $valueIndex => $val) {
            //echo $form->field($obj, "[$index]field")->checkboxList($obj->valuesArr)->label($obj->name);
            echo $form->field($handler, $attr)->checkboxList($object['items'], ['unselect' => null])->label($object['property']);
            //}
        }
        ?>

    </div>
</div>


