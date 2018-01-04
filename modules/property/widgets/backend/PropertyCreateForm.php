<?php
namespace app\modules\property\widgets\backend;

use app\modules\property\models\Group;
use app\modules\property\models\Object;
use yii\base\Widget;
use yii\helpers\Html;

class PropertyCreateForm extends Widget
{
    public $modelClass;
    public $action = 'property-create';


    public function run()
    {
        $groupList = Group::getList($this->modelClass);

        return  $this->render('property-create-form/index',
            ['modelClass' => $this->modelClass, 'groupList' => $groupList, 'action' => $this->action]);
    }
}