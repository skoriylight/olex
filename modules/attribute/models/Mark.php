<?php

namespace app\modules\attribute\models;

use Yii;

/**
 * This is the model class for table "attribute_mark".
 *
 * @property integer $id
 * @property integer $is_sale
 * @property integer $is_new
 * @property integer $is_hit
 * @property integer $is_coming
 * @property integer $is_stock
 * @property integer $product_id
 */
class Mark extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attribute_mark';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_sale', 'is_new', 'is_hit', 'is_coming', 'is_stock', 'product_id'], 'integer'],
            [['product_id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('goods', 'ID'),
            'is_sale' => Yii::t('goods', 'Is Sale'),
            'is_new' => Yii::t('goods', 'Is New'),
            'is_hit' => Yii::t('goods', 'Is Hit'),
            'is_coming' => Yii::t('goods', 'Is Coming'),
            'is_stock' => Yii::t('goods', 'Is Stock'),
            'product_id' => Yii::t('goods', 'Product ID'),
        ];
    }
}
