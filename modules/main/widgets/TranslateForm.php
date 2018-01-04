<?php

namespace app\modules\main\widgets;

use app\modules\property\models\Object;
use dosamigos\tinymce\TinyMce;
use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class TranslateForm extends InputWidget
{

    public $modelArr;
    public $typeFields;
    protected $form;
    public function init()
    {
        parent::init();
        if($this->model->isNewRecord) {
            $postAttribute = $this->attribute;
            $this->model->$postAttribute = $this->model->generateFieldsArray();
        }
        $this->field->label(false);
        $this->field->template = '{input}';
        $this->field->options = ['class' => ''];
        $this->modelArr = $this->model->{$this->attribute};
        $this->form =  $this->field->form;
    }

    public function run()
    {


        return  $this->render('translate-form/index',[
            'modelArr' => $this->modelArr,
            'model' => $this->model,
            'postAttribute' => $this->attribute,
            'options' => $this->options,
            'form' => $this->form,
        ]);
    }

    public function getTypeField($model,$attribute, $language = null ,$options = null){
        if($options === null){
            $options = $this->options;
        }
        if($language == null) {
            $attr_name = $attribute;
        } else {
            $attr_name = $this->attribute . "[$attribute][$language]";
        }

        $label = $model->attributeLabels();

        if(isset($this->typeFields[$attribute]) && $this->typeFields[$attribute] == 'editor') {
            return $this->form->field($model,$attr_name)->label($label[$attribute])->widget(TinyMce::className());
        } elseif(isset($this->typeFields[$attribute]) && $this->typeFields[$attribute] == 'area') {
            return $this->form->field($model,$attr_name)->textarea->label($label[$attribute]);
        } else {
            return $this->form->field($model,$attr_name)->label($label[$attribute]);
        }
    }
}