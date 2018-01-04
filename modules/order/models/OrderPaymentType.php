<?php

namespace app\modules\order\models;

use Yii;

/**
 * This is the model class for table "order_payment_type".
 *
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $widget
 * @property integer $order
 *
 * @property Order[] $orders
 * @property OrderPayment[] $orderPayments
 */
class OrderPaymentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_payment_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug', 'name'], 'required'],
            [['order'], 'integer'],
            [['slug', 'name', 'widget'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('catalog', 'ID'),
            'slug' => Yii::t('catalog', 'Slug'),
            'name' => Yii::t('catalog', 'Name'),
            'widget' => Yii::t('catalog', 'Widget'),
            'order' => Yii::t('catalog', 'Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['payment_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPayments()
    {
        return $this->hasMany(OrderPayment::className(), ['payment_type_id' => 'id']);
    }
}
