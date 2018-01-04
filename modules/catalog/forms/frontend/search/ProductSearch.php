<?php

namespace app\modules\catalog\forms\frontend\search;

use app\modules\catalog\models\Price;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalog\models\backend\Product;
use yii\db\Expression;

/**
 * ProductSearch represents the model behind the search form about `app\modules\catalog\models\backend\Product`.
 */
class ProductSearch extends Product
{

    public $category;
    public $order_by = ['{{%goods%}}.id' => SORT_ASC];
    /**
     * @inheritdoc
     */
    public $properties_val = [];

    public function rules()
    {
        return [
            [['id', 'position', 'parent_id', 'create_at', 'update_at', 'category_id'], 'integer'],
            [['name', 'title', 'description', 'content', 'article', 'color', 'attr_mark'], 'safe'],
            [['attr_mark'], 'each', 'rule' => ['integer']],

        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = Product::find();
        $prop = new ValueFilterSearch();
        $prop->load($params);
        $this->properties_val = $prop->filterValue;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {

            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,

            'position' => $this->position,
            'parent_id' => $this->parent_id,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,

        ]);

        $exists = (new \yii\db\Query())
            ->select(new Expression(1))
            ->from('catalog_category_entity')
            ->where('`catalog_category_entity`.`product_id` = `catalog_product`.`id`');


        if ($this->category !== null) {
            $exists->andWhere(['catalog_category_entity.category_id' => $this->category]);

        } else {
            $exists->andWhere(['IS NOT', 'catalog_category_entity.category_id', null]);
        }
        $query->where(['exists', $exists]);
        $query->joinWith('marks');


        foreach(['is_new', 'is_sale', 'is_hit', 'is_coming', 'is_stock'] as $attr) {
            $query = $this->addAttrQuery($query, $attr);
        }

        $query = $this->createPriceQuery($query);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            //->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'article', $this->article])
            ->andFilterWhere(['like', 'color', $this->color]);

        if ($this->properties_val) {
            foreach ($this->properties_val as $prop) {
                $condStr = 'IN (';
                foreach ($prop as $val) {
                    $condStr .= "$val ,";
                }
                $condStr = trim($condStr, ',') . ')';
                $query->andWhere(
                    "EXISTS(SELECT 1 FROM prop_handler_value LEFT JOIN prop_value ON prop_handler_value.value_id = prop_value.id WHERE catalog_product.id = prop_handler_value.handler_id AND prop_value.id " . $condStr . ')');

            }
        }

        //$query->andWhere("EXISTS(SELECT 1 FROM goods LEFT JOIN catalog_price ON goods.id = catalog_price.object_id WHERE goods.product_id = catalog_product.id)");
        //$query->joinWith('goods.prices')->groupBy('catalog_product.id');
        //$query->orderBy('MAX(catalog_price.value)');
        $query->with(['uploadedFiles', 'goods', 'goods.prices']);
        //$query->orderBy('some.product_id');

        return $dataProvider;
    }

    protected function addAttrQuery($query, $attr)
    {
        if (!empty($this->attr_mark[$attr])) {
            $query->andWhere(["attribute_mark.{$attr}" => 1]);
        }
        return $query;
    }

    protected function createPriceQuery($query){
        $type = Price::TYPE_DEFAULT;
        if (!empty($min = \Yii::$app->request->get('min-price')) && !empty($max = \Yii::$app->request->get('max-price'))) {
            $query->andWhere(
                "EXISTS(SELECT catalog_price.value, catalog_price.object_id, goods.product_id, goods.id FROM goods 
                LEFT JOIN catalog_price ON catalog_price.object_id = goods.id
                WHERE goods.product_id = catalog_product.id
                AND catalog_price.value >= $min
                AND catalog_price.value <= $max
                AND catalog_price.type = $type)"
            );

        }
        return $query;
    }

}
