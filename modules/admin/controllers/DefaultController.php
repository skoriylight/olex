<?php

namespace app\modules\admin\controllers;

use yii\caching\Cache;
use yii\web\Controller;

class DefaultController extends Controller
{

    pub
    public function actionIndex()
    {
        return $this->render('index');
    }

}
