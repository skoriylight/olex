<?php
namespace app\modules\property\widgets\backend\actions\property_create_form;

use app\modules\property\models\Group;
use app\modules\property\models\Object;
use yii\base\Action;

class PropertyCreate extends Action
{
    public function run()
    {
        $isSave = false;
        print_r($modelClass = \Yii::$app->request->get());

        $modelClass = \Yii::$app->request->get('modelClass');
        echo $modelClass;
        $propertyName = \Yii::$app->request->get('propertyName');
        $groupList = Group::getList($modelClass);
        $model = new Object();
        $model->class = $modelClass;
        if(!empty($propertyName)){
            $model->name = $propertyName;
            if($model->save()){
                $isSave = true;
            }

        }


        return $this->controller->renderAjax('@app/modules/property/widgets/backend/views/property-create-form/property-create',[
            'groupList' => $groupList,
            'isSave' => $isSave
        ]);
    }
}
