<?php

namespace app\modules\attribute;

use app\modules\admin\rbac\Rbac;
use yii\filters\AccessControl;

/**
 * attribute module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\attribute\controllers';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [Rbac::PERMISSION_MAIN_SITE],
                    ],
                ],
            ],
        ];
    }


    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
