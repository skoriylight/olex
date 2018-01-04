<?php

namespace app\modules\catalog\controllers\frontend;

use app\modules\catalog\forms\frontend\search\ProductSearch;
use app\modules\catalog\models\Category;
use app\modules\catalog\models\Product;
use app\modules\goods\models\Goods;
use yii\helpers\Json;
use yii\web\Controller;
use \yii;

/**
 * Default controller for the `catalog` module
 */
class CartController extends Controller
{
    public $layout = '@layouts/default';


    /**
     * Renders the index view for the module
     * @return string
     */


    public function actionAddElements()
    {

        $data = \Yii::$app->request->post('prod');
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = Goods::find()->where(['id' => array_keys($data)])->all();
        foreach ($model as $prod) {
            $count = is_numeric($data[$prod->id]) ? $data[$prod->id] : 1;
            if($count > 0){
                \Yii::$app->cart->put($prod, $count, []);
            }

        }

        return $this->_cartJson();

    }

    public function actionUpdateCount()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $id = \Yii::$app->request->post('id');
        $count = \Yii::$app->request->post('count');
        $this->updateCount($id, $count);

        return $this->_cartJson();
    }

    protected function updateCount($id, $count)
    {

        $model = Goods::findOne($id);
        $elementModel = \yii::$app->cart->cart->getElement($model, []);
        if($elementModel) {
            $elementModel->count = $count;
            $elementModel->save();

        } else {
            \Yii::$app->cart->put($model, $count, []);
        }

        return $this->_cartJson();
    }

    public function actionIndex($view = 'index')
    {
        return $this->render('index', ['view' => $view]);
    }


    private function _cartJson($json = [])
    {
        if ($cartModel = \Yii::$app->cart) {
            //$json['elementsHTML'] = \dvizh\cart\widgets\ElementsList::widget();
            $json['count'] = $cartModel->getCount();
            $json['price'] = $cartModel->getCostFormatted();
            $json['countList'] = $this->getElementCount();

            $json['priceList'] = $this->getElementPrice();
        } else {
            $json['count'] = 0;
            $json['price'] = 0;
        }
        return $json;
    }

    private function getElementCount()
    {
        $arr = [];
        foreach (\Yii::$app->cart->elements as $el) {
            $arr[$el->item_id] = $el->count;
        }
        return $arr;

    }
    private function getElementPrice()
    {
        $arr = [];
        foreach (\Yii::$app->cart->elements as $el) {
            $arr[$el->item_id] = $el->price * $el->count;
        }
        return $arr;
    }


    public function actionDeleteElement()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $json = ['result' => 'undefined', 'error' => false];
        $elementId = yii::$app->request->post('elementId');

        $cart = yii::$app->cart;

        $elementModel = $cart->getElementById($elementId);

        if($cart->deleteElement($elementModel)) {
            $json['result'] = 'success';
        }
        else {
            $json['result'] = 'fail';
        }

        return $this->_cartJson();
    }

    public function actionInfo(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $this->_cartJson();
    }
}
