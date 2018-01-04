<?php

namespace app\modules\order\models;

use mongosoft\file\UploadBehavior;
use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "order_shipping_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $cost
 * @property string $free_cost_from
 * @property integer $order
 *
 * @property Order[] $orders
 */
class OrderShippingType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_shipping_type';
    }

    public $image;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description', 'image_url', 'image_name', 'image_path'], 'string'],
            [['cost', 'free_cost_from'], 'number'],
            [['order'], 'integer'],
            ['extra_fields', 'boolean'],
            [['name'], 'string', 'max' => 255],
            //['image', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['insert', 'update']],
            ['image', 'safe']

        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('catalog', 'ID'),
            'name' => Yii::t('catalog', 'Name'),
            'description' => Yii::t('catalog', 'Description'),
            'cost' => Yii::t('catalog', 'Cost'),
            'free_cost_from' => Yii::t('catalog', 'Free Cost From'),
            'order' => Yii::t('catalog', 'Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function behaviors()
    {
        return [
            'file' => [
                'class' => \trntv\filekit\behaviors\UploadBehavior::className(),
                'filesStorage' => 'fileStorage', // my custom fileStorage from configuration(for properly remove the file from disk)
                'multiple' => false,
                'attribute' => 'image',
                'uploadRelation' => 'uploadedFiles',
                'pathAttribute' => 'image_path',
                'baseUrlAttribute' => 'image_url',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'image_name',
                'orderAttribute' => 'order',
                'uploadModel' => self::className()
            ],
        ];
    }

    public function getUploadedFiles()
    {
        return $this->hasOne(self::className(), ['id' => 'id']);
    }

    public function getImageUrl(){
        return $this->image_url. '/' . $this->image_path;
}

    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['shipping_type_id' => 'id']);
    }
}
