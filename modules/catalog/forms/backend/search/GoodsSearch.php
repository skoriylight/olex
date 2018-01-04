<?php

namespace app\modules\catalog\forms\backend\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\goods\models\Goods;

/**
 * GoodsSearch represents the model behind the search form about `app\modules\goods\models\Goods`.
 */
class GoodsSearch extends Goods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_color', 'product_id', 'sort', 'size'], 'integer'],
            [['name', 'full_name', 'color', 'path', 'type', 'file_name'], 'safe'],
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
        $query = Goods::find()->indexBy('id');

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
            'is_color' => $this->is_color,
            'product_id' => $this->product_id,
            'sort' => $this->sort,
            'size' => $this->size,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'file_name', $this->file_name]);

        return $dataProvider;
    }
}
