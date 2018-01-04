<?php

namespace app\modules\catalog;
use app\modules\admin\rbac\Rbac;
use yii\filters\AccessControl;

/**
 * catalog module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\catalog\controllers';

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
        \yii::$container->set('cartElement', 'app\modules\catalog\models\frontend\CartElement');
        parent::init();

        // custom initialization code goes here
    }

}
