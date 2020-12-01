<?php

namespace backend\modules\ipakyuli\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\ipakyuli\models\IpakyuliTransactions;

/**
 * IpakyuliTransactionsSearch represents the model behind the search form of `backend\modules\ipakyuli\models\IpakyuliTransactions`.
 */
class IpakyuliTransactionsSearch extends IpakyuliTransactions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'global_id', 'order_id', 'amount', 'terminal_num', 'room', 'user_id', 'success_date', 'error_date', 'error_code'], 'integer'],
            [['status', 'return_html', 'return_success_json', 'return_error_json'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = IpakyuliTransactions::find();

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
            'global_id' => $this->global_id,
            'order_id' => $this->order_id,
            'amount' => $this->amount,
            'terminal_num' => $this->terminal_num,
            'room' => $this->room,
            'user_id' => $this->user_id,
            'success_date' => $this->success_date,
            'error_date' => $this->error_date,
            'error_code' => $this->error_code,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'return_html', $this->return_html])
            ->andFilterWhere(['like', 'return_success_json', $this->return_success_json])
            ->andFilterWhere(['like', 'return_error_json', $this->return_error_json]);

        return $dataProvider;
    }
}
