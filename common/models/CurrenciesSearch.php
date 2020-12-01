<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Currencies;

/**
 * CurrenciesSearch represents the model behind the search form of `common\models\Currencies`.
 */
class CurrenciesSearch extends Currencies
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status',], 'integer'],
            [['code', 'symbol_left', 'symbol_right'], 'safe'],
            [['value'], 'number'],
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
        $query = Currencies::find();

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
            'value' => $this->value,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'symbol_left', $this->symbol_left])
            ->andFilterWhere(['like', 'symbol_right', $this->symbol_right]);

        return $dataProvider;
    }
}
