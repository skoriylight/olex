<?php

namespace app\modules\order\forms\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\order\models\OrderPayment;

/**
 * OrderPaymentSearch represents the model behind the search form about `app\modules\order\models\OrderPayment`.
 */
class OrderPaymentSearch extends OrderPayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'payment_type_id', 'user_id'], 'integer'],
            [['description', 'ip', 'date'], 'safe'],
            [['amount'], 'number'],
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
        $query = OrderPayment::find();

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
            'order_id' => $this->order_id,
            'payment_type_id' => $this->payment_type_id,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
