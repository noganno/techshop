<?php

namespace frontend\models;
use backend\models\Country;
use backend\models\Warranty;
use common\models\Attribute;
use common\models\AttributeGroup;
use common\models\Manufacturer;
use common\models\ProductAttribute;
use common\models\ProductToCategory;
use frontend\models\query\ProductQuery;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use frontend\models\query\CategoryQuery;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use yeesoft\multilingual\db\MultilingualQuery;

/**
 * Category model for frontend side
 **/

class CategoryWithBehavior extends \kartik\tree\models\Tree

{


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['multilingual'] = [
            'class' => MultilingualBehavior::className(),
            'languages' => [
                'ru' => 'Русский',
                'kr' => 'Ўзбек',
                'uz' => "O'zbek",
            ],
            'attributes' => [
                'meta_title', 'meta_description', 'meta_keywords',
            ]
        ];
        return $behaviors;
    }

    #region ActiveRecord methods
    public static function tableName()
    {
        return '{{%category}}';
    }

    public static function find()
    {
        $query = new CategoryQuery(get_called_class());

        return $query->addOrderBy('root, lft');
    }

    #endregion


    /**
     * Get all active sub categories belonged to this category
     * */

    public function getSubCategories()
    {
        $lvl = $this->lvl + 1;
        $rgt = $this->rgt;
        $lft = $this->lft;
        $root = $this->root;
        return Yii::$app->db->cache(function () use ($lvl, $rgt, $lft, $root){
            return  static::find()
                ->level($lvl)
                ->root($root)
                ->andWhere(['>', 'lft', $lft])
                ->andWhere(['<', 'rgt', $rgt])
                ->active()
                ->all()
                ;
        });
    }

    /**
     * Checks whether the category has sub categories
     * @return boolean true if the category has at least one sub category
     */

    public function getHasSubCategories()
    {
        return !empty($this->getSubCategories());

    }

    public function getParent()
    {

        $lvl = $this->lvl - 1;
        $rgt = $this->rgt;
        $lft = $this->lft;
        $root = 1;

        return Yii::$app->db->cache(function ($db) use ($lvl, $rgt, $lft, $root) {

            return static::find()
                ->level($lvl)
                ->root($root)
                ->andWhere(['<', 'lft', $lft])
                ->andWhere(['>', 'rgt', $rgt])
                ->one()
                ;

        });

    }

    public function getHasParent()
    {
        return $this->parent != null;
    }


    /**
     * Products related this category
     **/

    public function getProducts()
    {

        $query = new \frontend\models\query\ProductQuery(get_called_class());
        $activeRegion = Yii::$app->help->activeRegion;
        if ($activeRegion != null) {
            return $this->hasMany(Product::className(), ['id' => 'product_id'])
                ->viaTable('product_to_category', ['category_id' => 'id'])
                ->multilingual()
                ->joinWith('sklads')
                ->andWhere(['sklad.region_id' => $activeRegion->id])
                ->joinWith('productToSklads')
                ->andWhere(['>', 'product_to_sklad.quantity' , 0])
                ;
        }

        return $this->hasMany(Product::className(), ['id' => 'product_id'])
            ->viaTable('product_to_category', ['category_id' => 'id'])
            ->multilingual()
            ;
    }

    /**
     * Active Products related this category
     * */
    public function getActiveProducts()
    {
        return $this->getProducts()->active();
    }

    public function getManufacturers()
    {
        return $this->hasMany(Manufacturer::className(), ['id'=>'manufacturer_id'])
            ->via('activeProducts');
    }

    public function getCountries()
    {
        return $this->hasMany(Country::className(), ['id'=>'country_id'])
            ->via('activeProducts');
    }

    public function getWarranties()
    {
        return $this->hasMany(Warranty::className(), ['id'=>'warranty_id'])
            ->via('activeProducts');
    }

    public function getAttributeValues()
    {
        $lang = Yii::$app->language;
        return $this->hasMany(ProductAttribute::className(), ['product_id'=>'id'])
            ->andWhere(['language' => $lang])
            ->via('activeProducts');
    }

    public function getAttributesNames()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])
            ->via('attributeValues');
    }

    public function getAttributeGroups()
    {
        return $this->hasMany(AttributeGroup::class, ['id' => 'attribute_group_id'])
            ->via('attributesNames');
    }

    /**
     * Get all products (includes sub categories' products)
     */

    public function findActiveProducts()
    {
        $assigns = ProductToCategory::find()-> where(['in', 'category_id', $this->getSubcategoriesIds()])->all();
        $productIds = ArrayHelper::getColumn($assigns, 'product_id');
        return Product::find()->where(['in', 'product.id', $productIds])->active()->latest();
    }

    public function getAllActiveProducts()
    {
        return $this->findActiveProducts()->all();

    }

    public function getTitle()
    {
        switch (Yii::$app->language){
            case 'uz' : $title = $this->name_uz; break;
            case 'kr' : $title = $this->name_kr; break;
            default: $title = $this->name; break;
        }
        return Html::encode($title);
    }

    public function getDetailUrl()
    {
        $params[0] = 'product/category';


        if ($this->lvl == 2) {
            $params['c1'] =  $this->parent->slug;
        }

        if ($this->lvl == 3) {
            $params['c1'] =  $this->parent->parent->slug;
            $params['c2'] =  $this->parent->slug;
        }

        $params['id'] = $this->slug;


        return url_to($params);
    }

    public static function findActiveCategoryBySlug($slug='')
    {
        return Yii::$app->db->cache(function($db) use ($slug){
            return Category::find()->active()->andWhere(['slug' => $slug])->one();

        });
    }

    public static function findActiveCategoryById($id='')
    {
        return Yii::$app->db->cache(function($db) use ($id){
            return Category::find()->active()->andWhere(['id' => $id])->one();

        });
    }

    public static function mainCategories($lang)
    {
        return Yii::$app->db->cache(function ($db) {
            return Category::find()
                ->where(['root' => 1, 'lvl' => 1])
                ->active()
                ->all();
        });
    }

    /**
     * get all subcategories ids
     * */

    public function getSubcategoriesIds()
    {
        $ids = [];
        $ids[] = $this->id;
        $subCategories = $this->getSubCategories();
        if ( !empty($subCategories) ){

            foreach ($subCategories as $subCategory){
                $ids[] = $subCategory->id;
                $subsubCategories = $subCategory->getSubCategories();
                if (!empty($subsubCategories)){
                    foreach ($subCategory->getSubCategories() as $subsubCategory ){
                        $ids[] = $subsubCategory->id;
                    }
                }
            }
        }
        return $ids;
    }


    /**
     * Get all products (includes sub categories' products)
     * @return ProductQuery
     */

    public function findAllActiveProducts()
    {
        $assigns = ProductToCategory::find()-> where(['in', 'category_id', $this->getSubcategoriesIds()])->all();
        $productIds = ArrayHelper::getColumn($assigns, 'product_id');
        return Product::find()->where(['in', 'product.id', $productIds])->active()->latest();
    }


    public function getMainImage()
    {
        return  $this->lvl == 1 ? $this->menu_image : $this->image;
    }

    public function getMetaTitle()
    {
        if ($this->meta_title == ''){
            return $this->name;
        }
        return $this->meta_title;
    }

    public function getMetaDescription()
    {
        if ($this->meta_description == '' && $this->hasParent){
            return $this->parent->getMetaDescription();
        }
        return $this->meta_description;
    }

    public function getMetaKeywords()
    {
        if ($this->meta_keywords == '' && $this->hasParent){
            return $this->parent->getMetaKeywords();
        }
        return $this->meta_keywords;
    }

    public function getMetaImage()
    {
        if ($this->getMainImage() == '' && $this->hasParent){
            return $this->parent->getMetaImage();
        }
        return $this->getMainImage();
    }

}

