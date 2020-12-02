<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ObmenLogs;

/**
 * ObmenLogsSearch represents the model behind the search form of `backend\models\ObmenLogs`.
 */
class ObmenLogsSearch extends ObmenLogs
{
    /**
     * {@inheritdoc}
     */

    public $created_at_c; //start time
    public $created_at_e; //End time

    public function rules()
    {
        return [
            [['created_at_c', 'created_at_e','datetime'], 'safe'],//Modify create_at to the rule, otherwise the rule is not valid and the search cannot be executed
            [['id', 'is_from_1c', 'wrote_to_site', 'guid', 'sklad_id', 'count'], 'integer'],
            [['name', 'action'], 'safe'],
            [['sale_price', 'loan_price'], 'number'],
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
        $query = ObmenLogs::find();

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

        if ($this->created_at_c && $this->created_at_e) {
            $create_start = strtotime($this->created_at_c);
            $create_end = strtotime($this->created_at_e);
            $query->andWhere(['between', 'datetime', $create_start, $create_end]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'is_from_1c' => $this->is_from_1c,
            'wrote_to_site' => $this->wrote_to_site,
//            'datetime' => $this->datetime,
            'sale_price' => $this->sale_price,
            'loan_price' => $this->loan_price,
            'guid' => $this->guid,
            'sklad_id' => $this->sklad_id,
            'count' => $this->count,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'action', $this->action]);

        return $dataProvider;
    }
}
