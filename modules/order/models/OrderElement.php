<?php

namespace app\modules\order\models;

use app\modules\catalog\models\Product;
use app\modules\goods\models\Goods;
use Yii;

/**
 * This is the model class for table "order_element".
 *
 * @property integer $id
 * @property string $model
 * @property integer $order_id
 * @property integer $item_id
 * @property integer $count
 * @property string $price
 * @property string $base_price
 * @property string $description
 * @property string $options
 *
 * @property Order $order
 */
class OrderElement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_element';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'order_id', 'item_id', 'count'], 'required'],
            [['order_id', 'item_id', 'count'], 'integer'],
            [['price', 'base_price'], 'number'],
            [['description', 'options'], 'string'],
            [['model'], 'string', 'max' => 255],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('catalog', 'ID'),
            'model' => Yii::t('catalog', 'Model'),
            'order_id' => Yii::t('catalog', 'Order ID'),
            'item_id' => Yii::t('catalog', 'Item ID'),
            'count' => Yii::t('catalog', 'Count'),
            'price' => Yii::t('catalog', 'Price'),
            'base_price' => Yii::t('catalog', 'Base Price'),
            'description' => Yii::t('catalog', 'Description'),
            'options' => Yii::t('catalog', 'Options'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    public function getModelElement(){
        return $this->hasOne(Goods::className(), ['id' => 'item_id']);
    }
}
