<?php
namespace app\modules\catalog\widgets\backend;

use app\modules\catalog\models\Price;
use app\modules\property\models\Object;
use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class PriceForm extends InputWidget
{
    public $index = 0;





    public function run()
    {
        $index = $this->index > 0?"[{$this->index}]":'';
        return  $this->render('price-form/index',
            ['values' => $this->model->values, 'attr' => $this->attribute, 'model' => $this->model, 'index' => $index]);
    }



}