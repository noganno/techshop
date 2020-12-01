<?php

namespace frontend\models;

use common\models\ProductToCategory;
use Yii;

class Manufacturer extends \soft\db\SActiveRecord
{

    public static function tableName()
    {
        return 'manufacturer';
    }


    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['manufacturer_id' => 'id']);
    }

    public function getActiveProducts()
    {
        return $this->getProducts()
            ->andWhere(['product.status' => true, 'deleted' => false])
            ->orderBy(['created_at' => SORT_DESC]);
    }

    public function getProductToCategories()
    {
        return $this->hasMany(ProductToCategory::className(), ['product_id' => 'id'])
            ->via('products')
            ;
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->via('productToCategories')
            ;
    }

    public function getActiveCategories()
    {
        return $this->getCategories()
            ->andWhere(['status' => true, 'active' => true])
            ->addOrderBy('root, lft');
    }

}
