<?php



namespace frontend\models\query;

use frontend\models\Product;
use Yii;
use backend\models\ProductCategory;
use backend\models\PcAssign;
use yii\helpers\ArrayHelper;

class ProductQuery extends \soft\db\SActiveQuery

{

    public function active()

    {
        return $this->andWhere(['product.status' => 1, 'product.deleted' => false])->andWhere(['!=', 'product.is_new_product', 1]);
    }


    public function hit()
    {

        return $this->orderBy(['order_count' => SORT_DESC])->active()->limit(Product::HIT_PRODUCTS_COUNT );
    }

    public function new()
    {
        return $this->latest(Product::NEW_PRODUCTS_COUNT);
    }

    public function recommend()
    {
        return $this->andFilterWhere(['product.recommend' => true]);
    }

    public function top()
    {
        $this->orderBy(['product.order_count' => SORT_DESC]);
    }

}