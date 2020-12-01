<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CreditTypesOptions;

/**
 * CreditTypesOptionsSearch represents the model behind the search form about `common\models\CreditTypesOptions`.
 */
class CreditTypesOptionsSearch extends CreditTypesOptions
{

    public function attributes()
    {
        return array_merge(parent::attributes(), ['credit_types.name']);
   }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'credit_type_id', 'month'], 'integer'],
            [['deposit', 'foiz'], 'number'],
            ['credit_types.name', 'string'],
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
        $query = CreditTypesOptions::find()->joinWith('creditType');

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
            'credit_types_options.id' => $this->id,
            'credit_types_options.credit_type_id' => $this->credit_type_id,
            'credit_types_options.month' => $this->month,
            'credit_types_options.deposit' => $this->deposit,
            'credit_types_options.foiz' => $this->foiz,
        ]);

        $query->andFilterWhere(
            ['like', 'credit_types.name',$this->getAttribute('credit_types.name')]
        );

        return $dataProvider;
    }
}
