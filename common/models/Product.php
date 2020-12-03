<?php

namespace common\models;

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
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;
use zxbodya\yii2\galleryManager\GalleryBehavior;

class Product extends \soft\db\SActiveRecord
{
    use MultilingualLabelsTrait;

    public $categoryIds;
    public $attribute_values;
    public $softDelete = true;
    public $sklad_values;
    public $selectedProductId;

    public function fields()
    {
        return [
            'id',
            'unique_id',
            'name',
            'slug',
            'description',
            'model',
            'price' => function ($model) {
                return $model->price == NULL ? 0 : $model->price;
            },
            'deposit',
            'quantity',
            'status',
            'new',
            'recommend',
            'xit',
            'sale_price',
            'loan_price',
            'stock_status' => function ($model) {
                return "";
            },
            'manufacturer' => function ($model) {
                return $model->manufacturer ? $model->manufacturer->name : "";
            },

            'attributes' => 'productAttributes',
            'categories',
            'images' => function ($model) {
                return $model->getImages('detail');
            }
        ];
    }

    public static function tableName()
    {
        return 'product';
    }

    public function behaviors()
    {
        return array_merge([

            /*  [
                'class' => ProductToSkladBehavior::class,
              ],
              [
                  'class' => PCAssignBehavior::class,
              ],
              [
                  'class' => AttributeValues::class,
              ],*/
            [
                'class' => CyrillicSlugBehavior::class,
                'attribute' => 'name',
                'slugAttribute' => "slug"
            ],

            'galleryBehavior' => [
                'class' => GalleryBehavior::class,
                'type' => 'product',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@frontend/web') . '/images/gallery/product',
                'url' => '/images/gallery/product',
                'versions' => [
                    'card' => function ($img) {
                        $size = $img->getSize();
                        $box = new \Imagine\Image\Box($size->getWidth(), $size->getHeight());
                        return $img->copy()->resize($box->heighten(210));
                    },

                    'cart' => function ($img) {
                        $size = $img->getSize();
                        $box = new \Imagine\Image\Box($size->getWidth(), $size->getHeight());
                        return $img->copy()->resize($box->heighten(80));
                    },
                    'detail' => function ($img) {
                        $size = $img->getSize();
                        $box = new \Imagine\Image\Box($size->getWidth(), $size->getHeight());
                        return $img->copy()->resize($box->heighten(510));
                    },
                ]
            ]
        ], parent::behaviors());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['manufacturer_id', 'is_name_changed', 'weight_class_id', 'length_class_id', 'sort_order', 'status', 'viewed', 'created_at', 'updated_at', 'action', 'new', 'recommend', 'xit', 'deposit', 'selectedProductId', 'new_time', 'discount'], 'integer'],
            [['action_beginig_date', 'action_finishing_date'], 'safe'],
            [['order_count', 'weight', 'length'], 'integer'],
            [['price', 'loan_price', 'sale_price'], 'safe'],
            [['slug'], 'string', 'max' => 127],
            [['categoryIds', 'attribute_values', 'sklad_values'], 'safe'],
            [['description', 'unique_id'], 'string'],
            [['country_id', 'warranty_id', 'yellow_friday'], 'integer'],
            [['model', 'name', 'tag', 'meta_title', 'meta_description', 'meta_keyword'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function setAttributeLabels()
    {
        return [
            'model' => Yii::t('app', 'Model'),
            'quantity' => Yii::t('app', 'Quantity'),
            'totalQuantity' => Yii::t('app', 'Quantity'),
            'stock_status_id' => Yii::t('app', 'Stock Status'),
            'manufacturer_id' => Yii::t('app', 'Manufacturer'),
            'price' => Yii::t('app', 'Price'),
            'sale_price' => Yii::t('app', 'Full payment'),
            'categoryIds' => Yii::t('app', 'Categories'),
            'weight' => Yii::t('app', 'Weight'),
            'weight_class_id' => Yii::t('app', 'Weight Class'),
            'length' => Yii::t('app', 'Length'),
            'length_class_id' => Yii::t('app', 'Length Class'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
            'new' => Yii::t('app', 'New'),
            'xit' => Yii::t('app', 'Xit'),
            'recommend' => Yii::t('app', 'Recommend'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'tag' => Yii::t('app', 'Tag'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'yellow_friday' => Yii::t('app', 'Yellow Friday'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keyword' => Yii::t('app', 'Meta Tags'),
            'attribute_values' => Yii::t('app', 'Attribute Values'),
            'loan_price' => Yii::t('app', 'Loan Price'),
            'categoryList' => Yii::t('app', 'Categories'),
            'country_id' => Yii::t('app', 'Country'),
            'warranty_id' => Yii::t('app', 'Warranty'),
            'new_time' => t('Time added to main products'),
            'timeAddedMain' => t('Time added to main products'),
            'viewed' => t('Number of views'),
            'isNew' => t('New'),
            'discount' => t('Discount') . " (%)",

        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['bulk-category'] = ['categoryIds'];
        return $scenarios;
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

    public function getStockStatus()
    {
        return $this->hasOne(StockStatus::class, ['id' => 'stock_status_id']);
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('product_to_category', ['product_id' => 'id']);
    }

    public function getProductToCategories()
    {
        return $this->hasMany(ProductToCategory::className(), ['product_id' => 'id']);
    }

    public static function categoryProducts($category_id)
    {
        $products = [];
//        $temp_products = Yii::$app->db->createCommand("SELECT p.id,p_lang.name,m.name as manufacturer,p.* FROM product p
//        LEFT JOIN product_lang p_lang ON p_lang.owner_id = p.id
//        LEFT JOIN product_to_category pt ON pt.product_id = p.id
//        LEFT JOIN manufacturer m ON m.id = p.manufacturer_id
//        WHERE pt.category_id={$category_id}
//        AND p_lang.language = '{$lang}'")->queryAll();
//
//
//        foreach ($temp_products as $product) {
//            $product['categories'] = $this->getProductCategories($product['id'], $lang);
//            $product['attributes'] = $this->getAttributes($product['id'], $lang);
//            $product['image'] = $this->getImages($product['id'])[0];
//            $products[] = $product;
//        }
//        return $products;
        $products = Product::find()
            ->where(['in', 'categories', $category_id]);
    }

    public function getProductname()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id']);
    }

    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['id' => 'manufacturer_id']);
    }

    public function getRoute()
    {
        return ['site/product', 'id' => $this->id, 'slug' => $this->slug];
    }

    public function getUrl()
    {
        return \yii\helpers\Url::to($this->getRoute());
    }

    public function getProductAttributes()
    {
        $lang = Yii::$app->language;
        $attributes = Yii::$app->db->createCommand("SELECT p_attr.attribute_id,a.title,p_attr.text FROM product_attribute p_attr
        LEFT JOIN attribute_lang a ON a.owner_id = p_attr.attribute_id 
        WHERE p_attr.product_id = {$this->id}
        AND p_attr.language ='{$lang}' 
        AND a.language='{$lang}'")->queryAll();
        return $attributes;
    }

    /*

      public function getImages($type = 'preview')
      {

          $images = Yii::$app->db->cache(function($db) use ($type) {
              return $this->getBehavior('galleryBehavior')->getImages();
          });

          if (empty($images)) {
              return ['/images/no-image.png'];
          }


          foreach ($images as $image) {
              $result[] = $image->getUrl($type);
          }
          return $result;

      }

         public function getImage($type = 'preview')
      {
          $images = $this->getImages($type);
          if ($images == NULL) {
              return "";
          }
          return $images[0];
      }*/


    #region Images

    /**
     * All images of the product
     */


    public function getGalleryImages()
    {
        return $this->hasMany(\common\models\GalleryImage::class, ['ownerId' => 'id'])
            ->andWhere(['type' => 'product'])
            ->orderBy(['rank' => SORT_ASC]);
    }


    public function getImages($type = 'preview')
    {

        $images = $this->galleryImages;
        $result = [];

        foreach ($images as $image) {
            $result[] = "/images/gallery/product/{$this->id}/{$image->id}/{$type}.jpg";
        }

        return $result;

    }


    /**
     * Main image of the product
     */

    public function getImage($type = 'preview')
    {

        $images = $this->getImages($type);


        if ($images == null || empty($images) || $images[0] == '' || $images[0] == null) {
            return "/images/no-image.png";
        }

        return $images[0];
    }

    #endregion

    public static function findActiveOne($id = '')
    {
        return static::find()->where(['status' => 1, 'id' => $id])->one();
    }

    public static function findActiveModel($id = '')
    {
        return static::find()->where(['status' => 1, 'id' => $id])->one();
    }

    public function getCategoryName()
    {
        if (!empty($this->categories)) {
            return $this->categories[0]->name;
        }
        return "";
    }

    /**
     * Detail url on frontend side
     **/
    public function getDetailUrl()
    {
        return url_to(['product/detail', 'id' => $this->slug]);
    }


    public function getCategoryList()

    {

        return Html::ul($this->categories, ['item' => function ($item) {

            return Html::tag('li', $item->title);

        }]);

    }

    public function getSkladList()
    {
        $rows = '';

        $row = tag('th', "#", ['align' => 'center']);
        $row .= tag('th', "Склад");
        $row .= tag('th', "Количество");
        $rows .= tag('tr', $row);

        foreach ($this->productToSklads as $index => $item) {

            $row = tag('td', $index + 1);
            $row .= tag('td', $item->sklad->description);
            $row .= tag('td', $item->quantity);
            $rows .= tag('tr', $row);
        }


        return tag('table', $rows, ['class' => 'table table-bordered table-condensed']);

    }

    public function getImagesField($type = 'preview')
    {
        $result = '';
        foreach ($this->getBehavior('galleryBehavior')->getImages() as $image) {
            $result .= SHtml::img($image->getUrl($type)) . " ";
        }
        return $result;
    }


    public function getProductToSklads()
    {
        return $this->hasMany(ProductToSklad::class, ['product_id' => 'id']);
    }

    public function getSklads()
    {
        return $this->hasMany(Sklad::class, ['id' => 'sklad_id'])
            ->via('productToSklads');
    }


    public function getTotalQuantity()
    {
        $count = Yii::$app->db->cache(function ($db) {
            return $this->getProductToSklads()->sum('quantity');
        });

        return $count == null ? 0 : $count;
    }

    public function getQuantity()
    {


        $count = Yii::$app->db->cache(function ($db) {
            return $this->getProductToSklads()->sum('quantity');
        });

        return $count == null ? 0 : $count;
    }


    public function getIsNew()
    {
        return time() <= $this->new_time + 3 * 86400;
    }

    public function getTimeAddedMain()
    {
        return $this->new_time > 100 ? $this->new_time : null;
    }

}
