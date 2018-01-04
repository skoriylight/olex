<?php

namespace app\modules\order\forms\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\order\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\modules\order\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'payment_type_id', 'shipping_type_id', 'delivery_time_hour', 'delivery_time_min', 'user_id', 'seller_user_id', 'timestamp'], 'integer'],
            [['client_name', 'client_phone', 'email', 'client_city', 'promocode', 'reciver_name', 'reciver_phone', 'reciver_city', 'delivery_time_date', 'delivery_type', 'status', 'order_info', 'time', 'date', 'payment', 'comment', 'address'], 'safe'],
            [['cost', 'base_cost'], 'number'],
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
        $query = Order::find();

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
            'cost' => $this->cost,
            'base_cost' => $this->base_cost,
            'payment_type_id' => $this->payment_type_id,
            'shipping_type_id' => $this->shipping_type_id,
            'delivery_time_date' => $this->delivery_time_date,
            'delivery_time_hour' => $this->delivery_time_hour,
            'delivery_time_min' => $this->delivery_time_min,
            'user_id' => $this->user_id,
            'seller_user_id' => $this->seller_user_id,
            'date' => $this->date,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'client_name', $this->client_name])
            ->andFilterWhere(['like', 'client_phone', $this->client_phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'client_city', $this->client_city])
            ->andFilterWhere(['like', 'promocode', $this->promocode])
            ->andFilterWhere(['like', 'reciver_name', $this->reciver_name])
            ->andFilterWhere(['like', 'reciver_phone', $this->reciver_phone])
            ->andFilterWhere(['like', 'reciver_city', $this->reciver_city])
            ->andFilterWhere(['like', 'delivery_type', $this->delivery_type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'order_info', $this->order_info])
            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'payment', $this->payment])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
