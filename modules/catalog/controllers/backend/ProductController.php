<?php

namespace app\modules\catalog\controllers\backend;

use app\modules\catalog\forms\backend\search\GoodsSearch;
use app\modules\goods\models\Goods;
use app\modules\property\widgets\backend\actions\property_create_form\PropertyCreate;
use Yii;
use app\modules\catalog\models\backend\Product;
use app\modules\catalog\forms\backend\search\ProductSearch;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'upload' => [
                'class'=>'trntv\filekit\actions\UploadAction',
            ],
            'view-images' => [
                'class' => 'trntv\filekit\actions\ViewAction',
            ],

            'property-create' => [
                'class'=>PropertyCreate::className(),
            ]
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     *
     *
     */


    public function actionGoodsCreate($id){
        $model = new Goods();
        $model->product_id = $id;
        $model->load(Yii::$app->request->post());
        if($model->save()) {
            $this->redirect(['/admin/catalog/product/goods', 'id' => $model->product_id]);
        } else {
            print_r($model->errors);
        }

    }

    public function actionGoodsDelete($id){
        $model = self::findGoods($id);
        $model->delete();
        $this->redirect(['/admin/catalog/product/goods', 'id' => $model->product_id]);
    }

    public function actionGoods($id, $action = null){
        $modelProduct = $this->findModel($id);
        $searchModel = new GoodsSearch();
        $searchModel->product_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models = $dataProvider->getModels();
        $newModel = new Goods();
        $newModel->product_id = $id;

        if (Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models)) {

            foreach ($models as $model) {

                $model->save(false);
            }
            //return $this->refresh();
        }


            return $this->render('goods-form', [
                'dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'newModel' => $newModel,
                'modelProduct' => $modelProduct
            ]);

    }

    public function actionCreate()
    {
        $model = new Product;
        $modelsGoods = [new Goods];
        if ($model->load(Yii::$app->request->post())) {

            $modelsGoods = static::createMultiple(Goods::classname());
            Model::loadMultiple($modelsGoods, Yii::$app->request->post());
            foreach ($modelsGoods as $index => $modelGoods) {
                $modelGoods->sort = $index;

            }
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsGoods),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsGoods) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsGoods as $modelGoods) {
                            $modelGoods->product_id = $model->id;
                            if (($flag = $modelGoods->save(false)) === false) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->refresh();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'modelsGoods' => (empty($modelsGoods)) ? [new Goods] : $modelsGoods
        ]);
    }

    public static function createMultiple($modelClass, $multipleModels = [], $data = null)
    {
        $model    = new $modelClass;
        $formName = $model->formName();
        $post     = empty($data) ? Yii::$app->request->post($formName) : $data[$formName];
        $models   = [];

        if (! empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);

        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {

                    $models[] = $multipleModels[$item['id']];
                } else {

                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }


/**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $url = Yii::$app->request->post('redirect');
            if($url == 'update') {
                return $this->refresh();
            } elseif($url == 'goods') {
                $this->redirect(['goods', 'id' => $model->id]);
            } else {
                $this->redirect(['index', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,

        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findGoods($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
