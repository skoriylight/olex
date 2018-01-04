<?php

namespace app\modules\property\controllers;

use app\helpers\MLoad;
use app\modules\catalog\models\Product;
use app\modules\property\forms\backend\search\ValueSearch;
use app\modules\property\models\Object;
use app\modules\property\models\Value;
use yii\web\Controller;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\modules\property\forms\backend\search\ObjectSearch;

use  yii\base\Model;


/**
 * Default controller for the `property` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actions()
    {
        return [
            'upload' => [
                'class'=>'trntv\filekit\actions\UploadAction',
            ],

        ];
    }

    public function actionCreate(){
        $model = new Object();
        $model->class = Product::className();
        $model->load(Yii::$app->request->post());
        if($model->save()) {
            $this->redirect(['/admin/property/default/index']);
        } else {
            print_r($model->errors);
        }
    }

    public function actionDelete($id){
        $model = self::findModel($id);
        $model->delete();
        $this->redirect(['/admin/property/default/index']);
    }

    public function actionIndex($class = null)
    {
        $searchModel = new ObjectSearch();
        $searchModel->class = Product::className();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models = $dataProvider->getModels();
        $newModel = new Object();

        if (Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models)) {
            foreach ($models as $model) {
                $model->save(false);
            }
            return $this->refresh();
        }
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'newModel' => $newModel
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Object::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionCreateValue($id){
        $model = new Value();
        $model->object_id = $id;
        $model->load(Yii::$app->request->post());
        if($model->save()) {
            $this->redirect(['/admin/property/default/index-value', 'id' => $id]);
        } else {
            print_r($model->errors);
        }
    }

    public function actionDeleteValue($id){
        $model = self::findValue($id);
        $model->delete();
        $this->redirect(['/admin/property/default/index-value', 'id' => $model->object_id]);
    }

    public function actionIndexValue($id)
    {
        $searchModel = new ValueSearch();
        $searchModel->object_id = $id;
        $modelProperty = $this->findModel($id);

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models = $dataProvider->getModels();
        $newModel = new Value();
        $newModel->object_id = $id;
        if (Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models)) {
            foreach ($models as $model) {
                $model->save(false);
            }
            return $this->refresh();
        }
        return $this->render('index-value', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'newModel' => $newModel,
            'modelProperty' => $modelProperty,
        ]);
    }

    protected function findValue($id)
    {
        if (($model = Value::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
