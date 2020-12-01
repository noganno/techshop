<?php


namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\CategoryWithBehavior;
use frontend\models\Manufacturer;
use frontend\models\Product;
use soft\web\SController;
use Yii;
use yii\data\ActiveDataProvider;

class ProductController extends SController
{

    /**
     * @param string $id slug of the category
     */

    public function actionCategory($id = '')
    {

        $category = CategoryWithBehavior::findOne(['status' => 1, 'active' => 1, 'slug' => $id]);
        if ($category == null) {
            return $this->productView($id);
        }
        return $this->categoryView($category);
    }

    /**
     * @param string $id id of the product
     */
    public function actionDetail($id = '')
    {
        return $this->productView($id);
    }

    public function actionSearch()
    {

        $categoryId = Yii::$app->request->get('category', 'all');
        $key = e(Yii::$app->request->get('key'));

        $query = Product::find()->active();

        if ($categoryId != 'all') {
            $category = Category::findActiveCategoryById($categoryId);
            if ($category != null) {
                $query = $category->findAllActiveProducts();
            }
        }

        if ($key != '') {
            $lang = \Yii::$app->language;
            $query = $query
                ->joinWith('translations')
                ->andWhere(['product_lang.language' => $lang])
                ->andWhere(['like', 'product_lang.name', $key])
                ->distinct()
            ;

        } else {
            $query = $query->andWhere('0=1');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 12
            ]
        ]);

        \Yii::$app->db->cache(function () use ($dataProvider) {
            return $dataProvider->prepare();
        });

        return $this->render('search', [
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     *  Brand products
     **/

    public function actionBrand($id)
    {

        $brand = Manufacturer::findModel($id);
        $query = $brand->getActiveProducts()
            ->joinWith('translations')
            ->joinWith('categoryAssigns')
            ->with('categories')
            ->distinct()
            ->andWhere(['product_lang.language' => Yii::$app->language]);

        $filterMaxPrice = ceil($query->max('sale_price') / 100000) * 100000;
        $minPrice = Yii::$app->request->post('min-price', 0);
        $maxPrice = Yii::$app->request->post('max-price', $filterMaxPrice);

        $categories = $this->post('Categories', []);

        if ($this->post()) {

            /*   if ($this->post('new', false)){
                   $query = $query->new();
               }
               if ($this->post('recommend', false)){
                   $query = $query->recommend();
               }
               if ($this->post('hit', false)){
                   $query = $query->hit();
               }*/

            if (!empty($categories)) {
                $query = $query->andWhere(['in', 'product_to_category.category_id', $categories]);
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
        return $this->render('brandProducts', [
            'id' => $id,
            'brand' => $brand,
            'dataProvider' => $dataProvider,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'filterMaxPrice' => $filterMaxPrice,
            'categories' => is_array($categories) ? $categories : [],
        ]);

    }

    private function categoryView($category)
    {
        $subCategories = $category->subCategories;
        if ($subCategories) {
            return $this->render('category', [
                'subCategories' => $subCategories,
                'category' => $category
            ]);
        } else {
            $query = $category->getActiveProducts()

                ->joinWith('translations')
                ->with('attributeValues.attributeName.translations')
                ->with('categories')
//                ->with('manufacturer')
                ->with('country')
                ->distinct()
                ->andWhere(['product_lang.language' => Yii::$app->language])
            ;

            $attributeValues = $this->post('AttributeValue', []);
            $brands = $this->post('Brands', []);
            $countries = $this->post('Countries', []);
            $warranties = $this->post('Warranties', []);
            $filterMaxPrice = ceil($query->max('sale_price') / 100000) * 100000;
            $minPrice = Yii::$app->request->post('min-price', 0);
            $maxPrice = Yii::$app->request->post('max-price', $filterMaxPrice);
            if ($this->post()) {


                if (!empty($attributeValues)) {
                    $query = $query->joinWith('attributeValues')->andWhere(['in',  'product_attribute.text', $attributeValues]);
                  /*  foreach ($attributeValues as  $attributeValue){
                            $query = $query->andWhere(['=',  'product_attribute.text', $attributeValue]);
                    }*/
//                    dd($query->all());
                }
/*
                if (!empty($brands)) {
                    $query = $query->andWhere(['in', 'product.manufacturer_id', $brands]);
                }

                if (!empty($countries)) {
                    $query = $query->andWhere(['product.country_id' => $countries]);
                }

                if (!empty($warranties)) {
                    $query = $query->andWhere(['in', 'product.warranty_id', $warranties]);
                }*/

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

                ],
                'pagination' => [
                    'defaultPageSize' => 20,
                ]
            ]);

            \Yii::$app->db->cache(function () use ($dataProvider) {
                return $dataProvider->prepare();
            });

            return $this->render('categoryProducts', [
                'category' => $category,
                'dataProvider' => $dataProvider,
                'minPrice' => $minPrice,
                'maxPrice' => $maxPrice,
                'filterMaxPrice' => $filterMaxPrice,
                'attributeValues' => is_array($attributeValues) ? $attributeValues : [],
                'brands' => is_array($brands) ? $brands : [],
                'warranties' => is_array($warranties) ? $warranties : [],
                'countries' => is_array($countries) ? $countries : [],
            ]);
        }
    }

    private function productView($id='')
    {
        $model = Product::find()->andWhere(['product.status' => 1, 'product.id' => $id])->one();

        if ($model == null){
            not_found();
        }

        Yii::$app->recent->add($model->id);
        return $this->render('productDetail', ['model' => $model]);
    }

}