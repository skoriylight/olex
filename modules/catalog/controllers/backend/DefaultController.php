<?php

namespace app\modules\catalog\controllers\backend;

use yii\web\Controller;

/**
 * Default controller for the `catalog` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
