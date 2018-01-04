<?php

namespace app\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "catalog_category_entity".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $product_id
 */
class CategoryEntity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_category_entity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'product_id'], 'required'],
            [['category_id', 'product_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('catalog', 'ID'),
            'category_id' => Yii::t('catalog', 'Category ID'),
            'product_id' => Yii::t('catalog', 'Product ID'),
        ];
    }
}
