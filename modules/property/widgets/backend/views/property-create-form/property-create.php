<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php
if($isSave){
    echo 'SAVED';
}

echo Html::beginTag('div', ['class' => 'form-group']);
echo Html::label('Группа');
echo Html::dropDownList('groupList', '', $groupList,  ['class' => 'form-control']);
echo Html::endTag('div');

echo Html::beginTag('div', ['class' => 'form-group']);
echo Html::label('Свойтство');
echo Html::textInput('PropertyName', '', ['class' => 'form-control']);
echo Html::endTag('div');


echo Html::beginTag('div', ['class' => 'form-group']);
echo Html::a('Create Property', '#', ['class' => 'btn btn-success', 'id' => 'property-create-button']);
echo Html::endTag('div');
?>
