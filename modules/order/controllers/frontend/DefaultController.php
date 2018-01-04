<?php

namespace app\modules\order\controllers\frontend;

use app\modules\goods\models\GoodsHistory;
use app\modules\main\components\Tr;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `order` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layout = '@layouts/cabinet';

    public function actionIndex()
    {
        $this->view->title = Tr::t('order', 'ORDER_TITLE');
        $cart = Yii::$app->cart->elements;
        foreach($cart as $one){

            yii::$app->order->put($one->getModel(), $one->count);
        }

        if(Yii::$app->request->post('Order')) {
            if(yii::$app->order->save(Yii::$app->request->post())) {
                GoodsHistory::addHistoryFaforite(\yii::$app->cart->elements);
                foreach(\yii::$app->cart->elements as $el){
                    \yii::$app->cart->deleteElement($el);
                }
                $this->redirect(['/order/default/order-list']);
            }
        }

        return $this->render('index', ['model' => yii::$app->order->getOrder()]);
    }

    public function actionOrderList(){
        $data = \Yii::$app->order->userOrders->asArray()->all();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['id', 'name'],
            ],
        ]);
        return $this->render('order-list', ['dataProvider' => $dataProvider]);
    }
}
