<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Loans;

/**
 * LoansSearch represents the model behind the search form about `common\models\Loans`.
 */
class LoansSearch extends Loans
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['fio', 'birth_date', 'address', 'passport_number', 'passport_give_date', 'passport_expiry', 'paasport_authority', 'passport_propiska', 'inn', 'annual_income', 'mobile_phone', 'home_phone', 'work_phone'], 'safe'],
            [['total_amount'], 'number'],
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
        $query = Loans::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'birth_date' => $this->birth_date,
            'total_amount' => $this->total_amount,
        ]);

        $query->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'passport_number', $this->passport_number])
            ->andFilterWhere(['like', 'passport_give_date', $this->passport_give_date])
            ->andFilterWhere(['like', 'passport_expiry', $this->passport_expiry])
            ->andFilterWhere(['like', 'paasport_authority', $this->paasport_authority])
            ->andFilterWhere(['like', 'passport_propiska', $this->passport_propiska])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'annual_income', $this->annual_income])
            ->andFilterWhere(['like', 'mobile_phone', $this->mobile_phone])
            ->andFilterWhere(['like', 'home_phone', $this->home_phone])
            ->andFilterWhere(['like', 'work_phone', $this->work_phone]);

        return $dataProvider;
    }
}
