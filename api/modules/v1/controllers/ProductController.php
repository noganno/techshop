<?php

namespace api\modules\v1\controllers;

use common\models\Product;
use frontend\models\Category;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\rest\ActiveController;

class ProductController extends ActiveController
{

    public $modelClass = 'common\models\Product';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];


    public function actions()

    {

        $actions = parent::actions();


        unset($actions['index']);
        unset($actions['view']);

        return $actions;
    }

    public function actionView($id, $lang)
    {
        Yii::$app->language = $lang;
        $product = Product::findOne($id);
        return $product;
    }

    public function actionIndex($lang)

    {
        return Product::find()->localized($lang)->all();
    }


    public function actionList($category_id, $lang)
    {
        Yii::$app->language = $lang;
        $query = Product::find()
            ->joinWith('productToCategories')
            ->where(['product_to_category.category_id' => $category_id])
            ->andWhere(['status' => 1])
            ->orderBy(['created_at' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2, //set page size here
            ]
        ]);
        return $dataProvider;

    }


    public function actionNew($lang)
    {
        Yii::$app->language = $lang;
        $query = Product::find()
            ->orderBy('created_at DESC')
            ->limit(50);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10, //set page size here
            ]
        ]);
        $dataProvider->setTotalCount(50);
        return $dataProvider;
    }

    public function actionRecommend($lang)
    {
        Yii::$app->language = $lang;
        $query = Product::find()
            ->where(['recommend' => 1])
            ->andWhere(['status' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2, //set page size here
            ]
        ]);
        return $dataProvider;
    }

    public function actionXit($lang)
    {
        Yii::$app->language = $lang;
        $query = Product::find()
            ->orderBy('order_count DESC')
//            ->andWhere(['status' => 1])
            ->limit(30);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10, //set page size here
            ]
        ]);
        return $dataProvider;
    }

    public function actionDiscount($lang)
    {
        Yii::$app->language = $lang;
        $query = Product::find()
            ->where(['>', 'price', 0])
            ->orderBy('updated_at DESC')
            ->andWhere(['status' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2, //set page size here
            ]
        ]);
        return $dataProvider;
    }


    public function actionRelated($category_id, $lang)
    {
        Yii::$app->language = $lang;
        $query = Product::find()
            ->joinWith('productToCategories')
            ->where(['product_to_category.category_id' => $category_id])
            ->andWhere(['status' => 1])
            ->orderBy(['created_at' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10, //set page size here
            ]
        ]);
        return $dataProvider;
    }

    public function actionCartProductList()
    {

        try {

            $data = Json::decode(Yii::$app->request->post('ids'));
            Yii::$app->language = Yii::$app->request->get('lang');
//            $products = $data['ids'];

            $newProducts = Product::find()->where(['id' => $data])->all();


//            return Yii::$app->re;
            return $newProducts;
        } catch (\Exception $ex) {
            Yii::$app->response->statusCode = 404;
            return [
                'status' => false,
                'code' => $ex->getCode(),
                'message' => Yii::t('app', "So'rovda xatolik bor") . $ex->getMessage()
            ];
        }

    }

    public function actionFilter($id, $lang)
    {

        $category = Category::findOne(['status' => 1, 'active' => 1, 'slug' => $id]);
        $query = $category->getActiveProducts()
            ->joinWith('translations')
            ->joinWith('attributeValues')
            ->with('attributeValues.attributeName.translations')
            ->with('categories')
            ->distinct()
            ->andWhere(['product_lang.language' => Yii::$app->language]);
        $attributeValues = $this->post('AttributeValue', []);
        $brands = $this->post('Brands', []);
        $countries = $this->post('Countries', []);
        $warranties = $this->post('Warranties', []);
        $filterMaxPrice = ceil($query->max('sale_price') / 100000) * 100000;
        $minPrice = Yii::$app->request->post('min-price', 0);
        $maxPrice = Yii::$app->request->post('max-price', $filterMaxPrice);

        if ($this->post()) {
            if (!empty($attributeValues)) {
                $query = $query->andWhere(['in', 'product_attribute.text', $attributeValues]);
            }

            if (!empty($brands)) {
                $query = $query->andWhere(['in', 'product.manufacturer_id', $brands]);
            }

            if (!empty($countries)) {
                $query = $query->andWhere(['in', 'product.country_id', $countries]);
            }

            if (!empty($warranties)) {
                $query = $query->andWhere(['in', 'product.warranty_id', $warranties]);
            }
            $maxPrice = intval($maxPrice);
            if ($maxPrice > 0) {
                $query = $query->andWhere(['<=', 'sale_price', $maxPrice]);
            }

            $minPrice = intval($minPrice);
            $query = $query->andWhere(['>=', 'sale_price', $minPrice]);

        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
                'attributes' => [
                    'created_at',
                    'price' => [
                        'desc' => ['product.sale_price' => SORT_DESC],
                        'asc' => ['product.sale_price' => SORT_ASC],
                    ],
                    'name' => [
                        'desc' => ['product_lang.name' => SORT_DESC],
                        'asc' => ['product_lang.name' => SORT_ASC],
                    ],
                    'popular' => [
                        'desc' => ['product.order_count' => SORT_DESC],
                        'asc' => ['product.order_count' => SORT_ASC],
                    ],
                ],

            ]
        ]);
//        return $this->render('categoryProducts', [
//            'id' => $id,
//            'category' => $category,
//            'dataProvider' => $dataProvider,
//            'minPrice' => $minPrice,
//            'maxPrice' => $maxPrice,
//            'filterMaxPrice' => $filterMaxPrice,
//            'attributeValues' => is_array($attributeValues) ? $attributeValues : [],
//            'brands' => is_array($brands) ? $brands : [],
//            'warranties' => is_array($warranties) ? $warranties : [],
//            'countries' => is_array($countries) ? $countries : [],
//        ]);
    }

}