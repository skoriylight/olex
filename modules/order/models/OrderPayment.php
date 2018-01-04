<?php

namespace app\modules\order\models;

use Yii;

/**
 * This is the model class for table "order_payment".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $payment_type_id
 * @property integer $user_id
 * @property string $description
 * @property string $ip
 * @property string $amount
 * @property string $date
 *
 * @property Order $order
 * @property OrderPaymentType $paymentType
 */
class OrderPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'payment_type_id', 'user_id'], 'integer'],
            [['amount'], 'number'],
            [['date'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 55],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['payment_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderPaymentType::className(), 'targetAttribute' => ['payment_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('catalog', 'ID'),
            'order_id' => Yii::t('catalog', 'Order ID'),
            'payment_type_id' => Yii::t('catalog', 'Payment Type ID'),
            'user_id' => Yii::t('catalog', 'User ID'),
            'description' => Yii::t('catalog', 'Description'),
            'ip' => Yii::t('catalog', 'Ip'),
            'amount' => Yii::t('catalog', 'Amount'),
            'date' => Yii::t('catalog', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentType()
    {
        return $this->hasOne(OrderPaymentType::className(), ['id' => 'payment_type_id']);
    }
}
