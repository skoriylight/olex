<?php
namespace app\modules\property\widgets\backend;

use app\modules\property\models\Object;
use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class PropertyForm extends InputWidget
{
    public $group;

    public $className;



    public function run()
    {
        $value = $this->model->gruopValueForProperty($this->className);
        //$handlerValues = $this->handler()
        $this->field->label(false);

        return  $this->render('property-form/index',
            ['value' => $value, 'attr' => $this->attribute, 'handler' => $this->model, 'form' => $this->field->form]);
    }
}