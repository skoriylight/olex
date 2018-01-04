<?php

namespace app\modules\catalog\forms\frontend\search;

use app\modules\property\models\Value;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalog\models\backend\Product;

/**
 * ProductSearch represents the model behind the search form about `app\modules\catalog\models\backend\Product`.
 */
class ProductFilterSearch extends Product
{


    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function behaviors()
    {
        return [

            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'category_ids' => 'categories',
                ],
            ],


        ];
    }

    public function getCategories()
    {
        return $this->hasMany(CategoryFilterSearch::className(), ['id' => 'category_id'])
            ->viaTable('{{%catalog_category_entity%}}', ['product_id' => 'id']);
    }





}
