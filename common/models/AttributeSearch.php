<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Attribute;

/**
 * AttributeSearch represents the model behind the search form of `common\models\Attribute`.
 */
class AttributeSearch extends Attribute
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'attribute_group_id', 'sort_order', 'created_at', 'updated_at', 'filter','status'], 'integer'],
            ['title', 'string'],
            ['categoryIds', 'safe'],
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
        $query = Attribute::find()->joinWith('translations')->distinct();

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
            'attribute.id' => $this->id,
            'attribute.attribute_group_id' => $this->attribute_group_id,
            'attribute.sort_order' => $this->sort_order,
            'attribute.created_at' => $this->created_at,
            'attribute.updated_at' => $this->updated_at,
            'attribute.filter' => $this->filter,
            'attribute.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'attribute_lang.title', $this->title]);

        if ($this->categoryIds != '') {
            $categoryIds = explode(',', $this->categoryIds);
            $query->joinWith('categories')->andFilterWhere(['category.id' => $categoryIds]);
        }

        return $dataProvider;
    }
}
