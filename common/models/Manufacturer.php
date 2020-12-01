<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "manufacturer".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $image
 * @property int|null $sort_order
 */
class Manufacturer extends \soft\db\SActiveRecord
{

    public static function tableName()
    {
        return 'manufacturer';
    }


    public function rules()
    {
        return [
            [['sort_order', 'show_in_index_page'], 'integer'],
            [['name', 'image', 'url'], 'string', 'max' => 255],
            ['name' , 'required'],
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['manufacturer_id' => 'id']);
    }

    public function getActiveProducts()
    {
        return $this->getProducts()
            ->andWhere(['status' => true, 'deleted' => false])
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
