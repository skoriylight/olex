<?php

namespace app\modules\order\models;

use app\modules\main\components\Tr;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $client_name
 * @property string $client_phone
 * @property string $email
 * @property string $client_city
 * @property string $promocode
 * @property string $reciver_name
 * @property string $reciver_phone
 * @property string $reciver_city
 * @property string $cost
 * @property string $base_cost
 * @property integer $payment_type_id
 * @property integer $shipping_type_id
 * @property string $delivery_time_date
 * @property integer $delivery_time_hour
 * @property integer $delivery_time_min
 * @property string $delivery_type
 * @property string $status
 * @property string $order_info
 * @property string $time
 * @property integer $user_id
 * @property integer $seller_user_id
 * @property string $date
 * @property string $payment
 * @property integer $timestamp
 * @property string $comment
 * @property string $address
 *
 * @property OrderPaymentType $paymentType
 * @property OrderShippingType $shippingType
 * @property OrderElement[] $orderElements
 * @property OrderPayment[] $orderPayments
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order%}}';
    }

    protected $_options = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_name', 'client_phone', 'reciver_phone', 'client_city', 'reciver_name', 'reciver_city', 'shipping_type_id'], 'required'],
            [['cost', 'base_cost'], 'number'],
            [['payment_type_id', 'shipping_type_id', 'delivery_time_hour', 'delivery_time_min', 'user_id', 'seller_user_id', 'timestamp'], 'integer'],
            [['delivery_time_date', 'date'], 'safe'],
            [['delivery_type', 'order_info', 'payment', 'comment'], 'string'],
            [['client_name', 'client_city', 'reciver_name', 'reciver_city', 'address'], 'string', 'max' => 255],
            [['client_phone', 'reciver_phone'], 'string', 'max' => 20],
            [['email', 'promocode'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 155],
            [['time'], 'string', 'max' => 50],
            [['payment_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderPaymentType::className(), 'targetAttribute' => ['payment_type_id' => 'id']],
            [['shipping_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderShippingType::className(), 'targetAttribute' => ['shipping_type_id' => 'id']],
            ['options', 'safe'],

        ];
    }

    public function getOptions()
    {
        if (!is_null($data = Json::decode($this->order_info))) {
            return $data;
        } else {
            return [];
        }
    }

    public function setOptions($val)
    {
        $this->order_info = Json::encode($val);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Tr::t('order-main', 'ID'),
            'client_name' => Tr::t('order-main', 'CLIENT_NAME'),
            'client_phone' => Tr::t('order-main', 'CLIENT_PHONE'),
            'email' => Tr::t('order-main', 'EMAIL'),
            'client_city' => Tr::t('order-main', 'CLIENT_CITY'),
            'promocode' => Tr::t('order-main', 'PROMOCODE'),
            'reciver_name' => Tr::t('order-main', 'RECEIVER_NAME'),
            'reciver_phone' => Tr::t('order-main', 'RECEIVER_PHONE'),
            'reciver_city' => Tr::t('order-main', 'RECEIVER_CITY'),
            'cost' => Tr::t('order-main', 'COST'),
            'base_cost' => Tr::t('order-main', 'BASE_COST'),
            'payment_type_id' => Tr::t('order-main', 'PAYMENT_TYPE_ID'),
            'shipping_type_id' => Tr::t('order-main', 'SHIPPING_TYPE_ID'),
            'delivery_time_date' => Tr::t('order-main', 'DELIVERY_TIME_DATE'),
            'delivery_time_hour' => Tr::t('order-main', 'DELIVERY_TIME_HOUR'),
            'delivery_time_min' => Tr::t('order-main', 'DELIVERY_TIME_MIN'),
            'delivery_type' => Tr::t('order-main', 'DELIVERY_TYPE'),
            'status' => Tr::t('order-main', 'STATUS'),
            'order_info' => Tr::t('order-main', 'ORDER_INFO'),
            'time' => Tr::t('order-main', 'TIME'),
            'user_id' => Tr::t('order-main', 'USER_ID'),
            'seller_user_id' => Tr::t('order-main', 'SELLER_USER_ID'),
            'date' => Tr::t('order-main', 'DATE'),
            'payment' => Tr::t('order-main', 'PAYMENT'),
            'timestamp' => Tr::t('order-main', 'TIMESTAMP'),
            'comment' => Tr::t('order-main', 'COMMENT'),
            'address' => Tr::t('order-main', 'ADDRESS'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentType()
    {
        return $this->hasOne(OrderPaymentType::className(), ['id' => 'payment_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingType()
    {
        return $this->hasOne(OrderShippingType::className(), ['id' => 'shipping_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderElements()
    {
        return $this->hasMany(OrderElement::className(), ['order_id' => 'id']);
    }

    public function getElementsProvider($id)
    {
        $query = OrderElement::find()->where(['order_id' => $id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPayments()
    {
        return $this->hasMany(OrderPayment::className(), ['order_id' => 'id']);
    }

    public function my()
    {
        $session = yii::$app->session;
        if (!$userId = yii::$app->user->id) {
            if (!$userId = $session->get('tmp_user_id')) {
                $userId = md5(time() . '-' . yii::$app->request->userIP . Yii::$app->request->absoluteUrl);
                $session->set('tmp_user_id', $userId);
            }
            $one = $this->andWhere(['tmp_user_id' => $userId])->limit(1)->one();
        } else {
            $one = $this->andWhere(['user_id' => $userId])->limit(1)->one();
        }
        if (!$one) {
            $one = new \dvizh\cart\models\Cart();
            $one->created_time = time();
            if (yii::$app->user->id) {
                $one->user_id = $userId;
            } else {
                $one->tmp_user_id = $userId;
            }
            $one->updated_time = time();
            $one->save();
        }

        return $one;
    }


}
