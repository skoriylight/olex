<?php

namespace app\modules\catalog\controllers\backend;

use app\modules\catalog\models\backend\Product;
use app\modules\catalog\models\Category;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `catalog` module
 */
class AjaxController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionTree($id = null)
    {
        if(!is_null($id)) {
            $model = Product::find()->with(['categories'=>function($q){$q->select('id') ; }])
                ->select('id')->asArray()->where(['id' => $id])->one();
        } else {
            $model = [];
            $model['categories'] = [];
        }



        $arrSelected = ArrayHelper::map($model['categories'],'id', 'id');
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $category = Category::getCategoryTreeWithCount();

        return self::buildTree($category,$arrSelected);
    }

    private static function buildTree($model,$arrSelected){

        $arr = [];
        foreach ($model as $cat) {
            $arr[] = [
                'id' => $cat->id,
                'text' => $cat->name,
                'state' => [
                    'checked' => isset($arrSelected[$cat->id])?true:false,
                ],
                'children' => self::buildTree($cat->children,$arrSelected)
            ];
        }

        return $arr;
    }
}
