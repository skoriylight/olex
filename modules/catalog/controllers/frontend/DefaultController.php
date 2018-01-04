<?php

namespace app\modules\catalog\controllers\frontend;

use app\modules\catalog\forms\frontend\search\ProductSearch;
use app\modules\catalog\forms\frontend\search\ValueFilterSearch;
use app\modules\catalog\models\Category;
use app\modules\catalog\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `catalog` module
 */
class DefaultController extends Controller
{
    public $layout = '@layouts/catalog';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($category_slug = Null)
    {

        if(!is_null($category_slug)) {
            $category = Category::findOne(['slug' => $category_slug]);

            $category_id = $category->id;
        } else {
            $category = null;

            $category_id = null;
        }

        $ProductSearch = new ProductSearch;
        $ProductSearch->category = $category_id;

        //$dataProvider = $ProductSearch->search(\Yii::$app->request->queryParams);

        $query = \Yii::$app->shop->getProducts($category_id)
            ->joinParams(ValueFilterSearch::class)
            ->setAttributes()
            ->query;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        return $this->render('index',['category' => $category, 'category_id'=>$category_id,  'dataProvider' => $dataProvider]);
    }

    public function actionView($product_slug)
    {
        $model = $this->findModel($product_slug);

        return $this->render('view', ['model' => $model]);
    }

    public function actionViewModal($product_slug)
    {
        $model = $this->findModel($product_slug);

        return $this->renderAjax('view-modal', ['model' => $model]);
    }


    public function actionMain()
    {
        $this->layout = '@layouts/main';

        return $this->render('main');
    }

    protected function findModel($product_slug)
    {
        if (($model = Product::findOne(['slug' => $product_slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
