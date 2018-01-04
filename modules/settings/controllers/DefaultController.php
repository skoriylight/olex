<?php

namespace app\modules\settings\controllers;

use yii\caching\Cache;
use yii\web\Controller;

/**
 * Default controller for the `settings` module
 */
class DefaultController extends Controller
{

    public $layout = '@app/modules/admin/views/layouts/admin-panel';

    public function actions()
    {
        return [

            'index' => [
                'class' => 'pheme\settings\SettingsAction',
                'modelClass' => 'app\modules\settings\models\Setting',
                //'scenario' => 'site',	// Change if you want to re-use the model for multiple setting form.
                'viewName' => 'index'    // The form we need to render
            ],


        ];
    }

    public function actionClear(){
        \Yii::$app->cache->flush();

        return \Yii::$app->request->referrer ? $this->redirect(\Yii::$app->request->referrer) : $this->redirect(['/admin']);
    }

    /*public function actionIndex()
    {
        return $this->render('index');
    }*/
}
