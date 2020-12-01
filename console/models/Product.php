<?php

namespace console\models;

use common\models\behavior\AttributeValues;
use common\models\behavior\CyrillicSlugBehavior;
use common\models\behavior\PCAssignBehavior;
use common\models\behavior\ProductToSkladBehavior;
use common\models\query\ProductQuery;
use soft\behaviors\DeletableBahavior;
use soft\helpers\SHtml;
use soft\helpers\SUrl;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use Yii;
use yii\helpers\Html;
use zxbodya\yii2\galleryManager\GalleryBehavior;

class Product extends \soft\db\SActiveRecord
{
    use MultilingualLabelsTrait;

    public $categoryIds;
    public $attribute_values;
    public $softDelete = true;
    public $sklad_values;


    public static function tableName()
    {
        return 'product';
    }

    public function behaviors()
    {
        return array_merge([


            [
                'class' => CyrillicSlugBehavior::class,
                'attribute' => 'name',
                'slugAttribute' => "slug"
            ],
        ], parent::behaviors());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['manufacturer_id', 'weight_class_id', 'length_class_id', 'sort_order', 'status', 'viewed', 'created_at', 'updated_at', 'action', 'new', 'recommend', 'xit', 'deposit'], 'integer'],
            [['action_beginig_date', 'action_finishing_date'], 'safe'],
            [['price', 'order_count', 'sale_price', 'weight', 'length', 'loan_price'], 'number'],
            [['slug'], 'string', 'max' => 127],
            [['categoryIds', 'attribute_values', 'sklad_values'], 'safe'],
            [['description', 'unique_id'], 'string'],
            [['country_id', 'warranty_id'], 'integer'],
            [['model', 'name', 'tag', 'meta_title', 'meta_description', 'meta_keyword'], 'string', 'max' => 255],
        ];
    }



    public function setAttributeNames()
    {
        return [
            'multilingualAttributes' => [
                'name', 'description', 'tag', 'meta_title', 'meta_description', 'meta_keyword',
            ],
        ];
    }


    public static function find()
    {
        $query = new ProductQuery(get_called_class());
        return $query->multilingual();
    }

}
