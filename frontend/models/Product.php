<?php

namespace frontend\models;

/**
 * @property int $manufacturer_id Ishlab chiqaruvchi
 * @property int $quantity soni
 * @property int $deposit boshlang'ich to'lov foizi
 * @property string $model tovar modeli
 *
 */

use backend\models\Country;
use backend\models\Warranty;
use common\models\Attribute;
use common\models\AttributeGroup;
use common\models\behavior\AttributeValues;
use common\models\Manufacturer;
use common\models\ProductAttribute;
use common\models\ProductToCategory;
use common\models\ProductToSklad;
use common\models\Sklad;
use soft\helpers\SArray;
use Yii;
use yii\helpers\ArrayHelper;
use zxbodya\yii2\galleryManager\GalleryBehavior;


class Product extends \soft\db\SActiveRecord

{

    public const NEW_PRODUCTS_COUNT = 50;
    public const HIT_PRODUCTS_COUNT = 50;

    #region Inherited ActiveRecord methods

    public static function tableName()
    {
        return '{{%product}}';
    }


    public static function find()
    {
        $query = new \frontend\models\query\ProductQuery(get_called_class());
        $activeRegion = Yii::$app->help->activeRegion;
        if ($activeRegion != null) {
            return $query->multilingual()
                ->with(['galleryImages', 'productToSklads'])
                ->joinWith('sklads')
                ->andWhere(['sklad.status' => 1])
                ->andWhere(['sklad.region_id' => $activeRegion->id])
                ->joinWith('productToSklads')
                ->andWhere(['>', 'product_to_sklad.quantity', 0]);
        }
        return $query->active()->multilingual();
    }

    #endregion

    public function setAttributeNames()
    {
        return [
            'multilingualAttributes' => ['name', 'description', 'tag', 'meta_title', 'meta_description', 'meta_keyword'],
        ];
    }


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

    /**
     * Get all categories related to this product
     **/

    public function getCategories()
    {
        return Yii::$app->db->cache(function ($db) {
            return $this->hasMany(Category::className(), ['id' => 'category_id'])
                ->viaTable('product_to_category', ['product_id' => 'id']);

        });
    }

    /**
     * Get first category related to this product
     **/
    public function getCategory()
    {
        return Yii::$app->db->cache(function ($db) {
            return $this->hasOne(Category::className(), ['id' => 'category_id'])
                ->viaTable('product_to_category', ['product_id' => 'id']);
        });
    }

    public function getCurrentCategory()
    {
        $categorySlug = Yii::$app->request->get('id');
        $category = Category::findActiveCategoryBySlug($categorySlug);
        if ($category == null) {
            $categoryId = Yii::$app->session->get('currentCategoryId');
            $category = Category::findActiveCategoryById($categoryId);
        }

        if ($category != null) {
            if (in_array($category->id, ArrayHelper::getColumn($this->categories, 'id'))) {
                return $category;
            }
        }

        return Yii::$app->db->cache(function ($db) {
            return $this->category;
        });
    }

    public function getCategoryName($currentCategory = true)
    {
        if ($currentCategory) {
            $currentCategory = $this->currentCategory;
            if ($currentCategory != null) {
                return $currentCategory->title;
            }
        }

        if (!empty($this->categories)) {
            return $this->categories[0]->title;
        }
        return "";
    }

    public function getDetailUrl()
    {

//        return url_to(['product/detail', 'id' => $this->id]);

        $category = $this->currentCategory;

        if ($category != null) {
            if ($category->lvl == 1) {
                $params[0] = 'product/category';
                $params['c1'] = $category->parent->slug;
                $params['id'] = $this->id;
                return url_to($params);
            }

            if ($category->lvl == 2) {
                $params[0] = 'product/category';
                $params['c1'] = $category->parent->slug;
                $params['c2'] = $category->slug;
                $params['id'] = $this->id;
                return url_to($params);
            }
            if ($category->lvl == 3) {
                $params[0] = 'product/detail';
                $params['c1'] = $category->parent->parent->slug;
                $params['c2'] = $category->parent->slug;
                $params['c3'] = $category->slug;
                $params['id'] = $this->id;
                return url_to($params);
            }


        }

        return url_to(['product/detail', 'id' => $this->id]);


    }

    public function getAttributeValues()
    {
        $lang = Yii::$app->language;
        return $this->hasMany(ProductAttribute::className(), ['product_id' => 'id'])
            ->andWhere(['product_attribute.language' => $lang,]);
    }

    public function getAttributesNames()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])
            ->andWhere(['status' => 1])
            ->via('attributeValues');
    }

    public function getAttributeGroups()
    {
        return $this->hasMany(AttributeGroup::class, ['id' => 'attribute_group_id'])
            ->via('attributesNames');
    }

    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::class, ['id' => 'manufacturer_id']);
    }


    public static function findActiveProduct($id = '')
    {
        $product = Product::getDb()->cache(function ($db) use ($id) {
            return Product::find()->active()->andWhere(['product.id' => $id])->one();
        });
        return $product;
    }

    public static function findActiveProductOrFail($id = '')
    {
        $product = static::findActiveProduct($id);
        if ($product == null) {
            not_found();
        }
        return $product;
    }


    public function getIsNew()
    {
        $latest = Yii::$app->db->cache(function ($db) {
            return static::find()->latest(static::NEW_PRODUCTS_COUNT)->active()->indexBy('id')->all();
        });

        return SArray::keyExists($this->id, $latest);
    }

    public function getIsHit()
    {
        return $this->xit;
    }

    public function getIsRecommend()
    {
        return $this->recommend;
    }


    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    public function getWarranty()
    {
        return $this->hasOne(Warranty::className(), ['id' => 'warranty_id']);
    }

    public function getCategoryAssigns()
    {
        return $this->hasMany(ProductToCategory::className(), ['product_id' => 'id']);
    }

    #region Sklads

    public function getStockStatus()
    {
//        if ($this->quantity > 0) {
        return t('In stock');
//        } else {
//            return t('Temporarily not');
//        }
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

    public function getQuantity()
    {
        return $this->getProductToSklads()->sum('quantity');
    }

    public function getRelatedProducts()
    {
        $category = $this->currentCategory;
        $relatedProducts = $category->findActiveProducts()->andWhere(['!=', 'id', $model->id])->limit(10)->all();

    }

    #endregion


    public function getMetaTitle()
    {
        if ($this->meta_title == '') {
            return $this->name;
        }
        return $this->meta_title;
    }

    public function getMetaDescription()
    {
        if ($this->meta_description == '' && $this->category != null) {
            return $this->category->getMetaDescription();
        }
        return $this->meta_description;
    }

    public function getMetaKeywords()
    {
        if ($this->meta_keyword == '' && $this->category != null) {
            return $this->category->getMetaKeywords();
        }
        return $this->meta_keyword;
    }

    public function getMetaImage()
    {
        if ($this->getImage() == '' && $this->category != null) {
            return $this->category->getMainImage();
        }
        return $this->getImage();
    }

    public function getHasDiscount()
    {
        return intval($this->discount) > 0;
    }

    /**
     * Agar tovarda skidka bo'lsa, tovar narxiga skidka bo'lgan narxni qo'shib, eski narxni hisoblaydi
     * Eski narx hozirgi narxdan katta bo'ladi
     * @return integer
     */
    public function getOldPrice()
    {

        if (!$this->hasDiscount) {
            return;
        }
        $oldPrice = $this->sale_price * 100 / (100 - $this->discount);
        return Yii::$app->formatter->asSum($oldPrice);
    }


    /**
     * Agar tovarda skidka bo'lsa, tovar narxiga skidka bo'lgan narxni narxni hisoblaydi
     * @return integer
     */
    public function getEconomPrice()
    {

        if (!$this->hasDiscount) {
            return 0;
        }
        $oldPrice = $this->sale_price * 100 / (100 - $this->discount);
        return Yii::$app->formatter->asSum($oldPrice - $this->sale_price);

    }

    public function getDiscountCircleLabel()
    {
        if ($this->hasDiscount)
            return '<span class="discount-yellow__percent">' . $this->discount . '%</span>';
        else return null;
    }

    public function getDiscountRedText()
    {
        if ($this->hasDiscount)
            return '<span class="discount-red-text">' . t('Discount') . " " . $this->discount . '%</span>';
        else return null;
    }

    public function getDiscountOldDeletedText()
    {
        if ($this->hasDiscount)
            return '<span class="discount-del-label">' . $this->oldPrice . '</span><br>';
        else return null;
    }

    public function getProductLabel()
    {
        if ($this->yellow_friday == 1)
            return "<span class='product_new product_yellow_friday'>" . t('Yellow Friday Badge') . "</span>";
        elseif ($this->isNew)
            return "<span class='product_new'>" . t('New') . "</span>";
        elseif ($this->isHit)
            return "<span class='product_bestseller'>" . t('Hit sale') . "</span>";
        elseif ($this->isRecommend)
            return "<span class='product_recommended'>" . t('Recommended') . "</span>";
        return "";
    }

}

