<?php

namespace app\modules\catalog\forms\frontend\search;

use app\modules\property\models\Object;
use app\modules\property\models\Value;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalog\models\backend\Product;

/**
 * ProductSearch represents the model behind the search form about `app\modules\catalog\models\backend\Product`.
 */
class ValueFilterSearch extends Value
{

    public $filterValue = [];

    public function rules()
    {
        return [
            [['order'], 'integer'],
            [['name', 'alias', 'object_id'], 'string', 'max' => 255],
            ['filterValue', 'safe']
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }


    public function getFilterValues($category_id = null){
        $q = is_null($category_id)?['IS NOT','catalog_category.id', null]:['catalog_category.id' => $category_id];



        $query = static::find()->joinWith(['handlers.categories'])
            ->where($q)
            ->andWhere(['IS NOT','catalog_product.id', null])
            ->andWhere(['prop_group.alias' => 'filters'])
            ->joinWith('property.groups')->all();
        return $query;
    }

    public function getBrandValues($category_id = null){
        $q = is_null($category_id)?['IS NOT','catalog_category.id', null]:['catalog_category.id' => $category_id];



        $query = static::find()->joinWith(['handlers.categories'])
            ->where($q)
            ->andWhere(['IS NOT','catalog_product.id', null])
            ->andWhere(['prop_group.alias' => 'brands'])
            ->joinWith('property.groups')->all();
        return $query;
    }





    public function getProperty(){
        return $this->hasOne(Object::className(), ['id' => 'object_id']);
    }

    public function getHandlers(){

        return $this->hasMany(ProductFilterSearch::className(), ['id' => 'handler_id'])
            ->viaTable('{{%prop_handler_value%}}', ['value_id' => 'id']);
    }

    public function getHandlerValues(){

    }


}
