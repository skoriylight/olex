<?php

namespace app\modules\favorite\controllers;

use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `favorite` module
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

    public function actionPut(){

        $id = \Yii::$app->request->post('id');
        $model_class = \Yii::$app->request->post('model_class');
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = $model_class::find()->where(['id' => $id])->limit(1)->one();
        if($model->favorite === null){
            \Yii::$app->favorite->put($model);
            $json = ['action' => 'put'];
        } else {
            \Yii::$app->favorite->deleteElement($model);
            $json = ['action' => 'delete'];
        }


        return $this->_cartJson($json);
    }

    public function actionDelete(){

        $id = \Yii::$app->request->post('id');
        $model_class = \Yii::$app->request->post('model_class');
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = $model_class::find()->where(['id' => $id])->limit(1)->one();


            \Yii::$app->favorite->deleteElement($model);


        return $this->_cartJson();
    }

    private function _cartJson($json = [])
    {
        if ($favoriteModel = \Yii::$app->favorite) {
            $json['count'] =\Yii::$app->favorite->count;
        } else {
            $json['count'] = 0;
        }
        return $json;
    }
}
