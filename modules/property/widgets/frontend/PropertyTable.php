<?php

namespace app\modules\property\widgets\frontend;

use yii\base\Widget;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

Class PropertyTable extends Widget
{

    public $model;

    public function run()
    {


        return $this->render('property-table/index', [
            'model' => $this->model->propValuesArr
        ]);
    }

}