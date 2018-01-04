<?php

namespace app\modules\catalog\forms\backend\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalog\models\backend\Product;

/**
 * ProductSearch represents the model behind the search form about `app\modules\catalog\models\backend\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'position', 'parent_id', 'create_at', 'update_at', 'category_id'], 'integer'],
            [['name', 'title', 'slug', 'description', 'content', 'article', 'color'], 'safe'],

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

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
          //  ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'article', $this->article])
            ->andFilterWhere(['like', 'color', $this->color]);

        return $dataProvider;
    }
}
