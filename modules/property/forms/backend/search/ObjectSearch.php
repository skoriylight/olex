<?php

namespace app\modules\property\forms\backend\search;

use app\modules\property\models\Object;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;



/**
 * GoodsSearch represents the model behind the search form about `app\modules\goods\models\Goods`.
 */
class ObjectSearch extends Object
{
    /**
     * @inheritdoc
     */


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
        $query = Object::find()->indexBy('id');

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
            'class' => $this->class,

        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias]);


        return $dataProvider;
    }
}
