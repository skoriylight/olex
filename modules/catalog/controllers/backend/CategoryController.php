<?php

namespace app\modules\catalog\controllers\backend;

use Yii;
use app\modules\catalog\models\backend\Category;
use app\modules\catalog\forms\backend\search\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use paulzi\adjacencyList\AdjacencyListQueryTrait;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    use AdjacencyListQueryTrait;

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

        ];
    }


    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex($id = null)
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && ($model->isNewRecord ? $model->makeRoot()->save() : $model->save())) {

            return $this->refresh();
        }



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->makeRoot()->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id = null)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && ($model->isNewRecord ? $model->makeRoot()->save() : $model->save())) {


        }
        return $this->redirect('index', ['id' => $id]);
    }

    public function actionUpdateTree()
    {
        $data = Category::find()
            //->select('name as label , id')
            ->with(['children' => function ($q) {
                $q->with('children');
            }])
            ->andWhere(['parent_id' => null])
            ->orderBy('position')
            //-> with(['children' => function($q){
            //    $q->select('name as label , parent_id');
            //}])

            ->asArray()
            ->all();

        foreach ($data as $child1) {
            foreach ($child1['children'] as $child2) {
                foreach ($child2['children'] as $child3) {
                    $child3['is_selected'] = true;
                }
            }
        }
        return $this->render('update-tree', [
            'data' => $data
        ]);

    }

    public function actionMove($move_id, $id, $position)
    {
        $move_model = Category::findOne(['id' => $move_id]);
        $model = Category::findOne(['id' => $id]);

        switch ($position) {
            case 'inside' :
                $move_model->prependTo($model)->save();
                break;
            case 'after' :
                $move_model->insertAfter($model)->save();
                break;
            case 'before' :
                $move_model->insertBefore($model)->save();
                break;
        }


    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteNode($id)
    {
        $this->findModel($id)->deleteWithChildren();

    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            return new Category();
        }
    }

    public function render($view, $params = [])
    {
        if (Yii::$app->request->getIsAjax()) {
            Yii::trace('Rendering AJAX');
            return parent::renderAjax($view, $params);
        } else {
            return parent::render($view, $params);
        }
    }
}
