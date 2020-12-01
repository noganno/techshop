<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */

    public $labelSort;
    public $skladId;
    public $emptyCategory = false;
    public $is_name_changed = 0;
    public $is_new_product = 0;

    public function rules()
    {
        return [
            [['id', 'manufacturer_id', 'weight_class_id', 'length_class_id', 'sort_order', 'status', 'viewed', 'created_at', 'updated_at', 'is_new_product'], 'integer'],
            [['slug', 'model', 'unique_id', 'is_name_changed'], 'safe'],
            [['price', 'sale_price', 'loan_price', 'weight', 'length'], 'number'],
            [['name', 'unique_id'], 'string'],
            [['price', 'sale_price'], 'number'],
            [['categoryIds', 'labelSort'], 'safe'],
            ['skladId', 'integer'],
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

    public function search($params)
    {
        $query = Product::find()->where(['deleted' => false])
            ->with('sklads')
            ->with('categories')
            ->with('productToSklads.sklad')
            ->with('galleryImages')
            ->joinWith('sklads')
            ->indexBy('id')
            ->distinct()
            ->joinWith('translations');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [

                'name',
                'price',
                'sklad_id',
                'unique_id',
                'sale_price',
                'loan_price',
                'created_at',
                'updated_at',
                'status',
                'xit',
                'deleted',
                'new',
                'recommend',
                'totalQuantity' => [
                    'asc' => ['product_to_sklad.quantity' => SORT_ASC],
                    'desc' => ['product_to_sklad.quantity' => SORT_DESC],
                ],

            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        if ($this->emptyCategory) {

//            $query->joinWith('productToCategories')->andWhere(['product_to_category.id' => null])->andWhere(['is_new_product' => 0]);
//            $query->joinWith('categories')->andWhere(['category.id' => null]);
        }

//        dd($query);

        if ($this->is_new_product) {
            $query->andFilterWhere([
                'product.is_new_product' => $this->is_new_product,
//            'product.is_name_changed' => $this->is_name_changed,
            ]);
        } elseif ($this->is_name_changed) {
            $query->andFilterWhere([
                'product.is_new_product' => $this->is_new_product,
                'product.is_name_changed' => $this->is_name_changed,]);

        } else {
            $query->andFilterWhere([
                'product.is_new_product' => $this->is_new_product,
            ]);
        }


        $query->andFilterWhere([
            'product.id' => $this->id,
            'product.manufacturer_id' => $this->manufacturer_id,
            'product.price' => $this->price,
            'product.sale_price' => $this->sale_price,
            'product.weight' => $this->weight,
            'product.weight_class_id' => $this->weight_class_id,
            'product.length' => $this->length,
            'product.length_class_id' => $this->length_class_id,
            'product.sort_order' => $this->sort_order,
            'product.status' => $this->status,
            'product.viewed' => $this->viewed,
            'product.created_at' => $this->created_at,
            'product.updated_at' => $this->updated_at,
            'product.xit' => $this->xit,
            'product.new' => $this->new,
            'product.recommend' => $this->recommend,
            'product.unique_id' => $this->unique_id,
//            'product.is_new_product' => $this->is_new_product,
//            'product.is_name_changed' => $this->is_name_changed,
            'sklad.id' => $this->skladId,

        ]);


        if ($this->labelSort != '') {

            $query->andFilterWhere([
                'product.'.$this->labelSort => 1
            ]);
        }

        if ($this->categoryIds != '') {

            $categoryIds = explode(',', $this->categoryIds);
            $query->joinWith('categories')->andFilterWhere(['category.id' => $categoryIds]);

        }

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'model', $this->model]);

        $lang = \Yii::$app->language;
        $query->andFilterWhere(['product_lang.language' => $lang])
            ->andFilterWhere(['like', 'product_lang.name', $this->name]);
        return $dataProvider;
    }
}
