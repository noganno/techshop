<?php

namespace backend\modules\ipakyuli\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\ipakyuli\models\IpakyuliSettings;

/**
 * IpakyuliSettingsSearch represents the model behind the search form of `backend\modules\ipakyuli\models\IpakyuliSettings`.
 */
class IpakyuliSettingsSearch extends IpakyuliSettings
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'terminal_num', 'created_at', 'updated_at'], 'integer'],
            [['test_key', 'main_key', 'room_enter_name', 'status', 'success_url', 'error_url', 'redirect_url'], 'safe'],
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
        $query = IpakyuliSettings::find();

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
            'terminal_num' => $this->terminal_num,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'test_key', $this->test_key])
            ->andFilterWhere(['like', 'main_key', $this->main_key])
            ->andFilterWhere(['like', 'room_enter_name', $this->room_enter_name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'success_url', $this->success_url])
            ->andFilterWhere(['like', 'error_url', $this->error_url])
            ->andFilterWhere(['like', 'redirect_url', $this->redirect_url]);

        return $dataProvider;
    }
}
