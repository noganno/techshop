<?php

namespace common\models;

use common\models\behavior\CyrillicSlugBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use yeesoft\multilingual\db\MultilingualQuery;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int|null $root
 * @property int $lft
 * @property int $rgt
 * @property int $lvl
 * @property string|null $name_uz
 * @property string|null $name
 * @property string|null $name_kr
 * @property string|null $menu_image
 * @property string|null $image
 * @property int|null $status
 * @property string|null $icon
 * @property int $icon_type
 * @property int $active
 * @property int $selected
 * @property int $disabled
 * @property int $readonly
 * @property int $visible
 * @property int $collapsed
 * @property int $movable_u
 * @property int $movable_d
 * @property int $movable_l
 * @property int $movable_r
 * @property int $removable
 * @property int $removable_all
 * @property int $child_allowed
 */
class Category extends \kartik\tree\models\Tree
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    public function fields()
    {
        return [
            'id',
            'title',
            'image'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status','position'], 'integer'],
            [['name_uz', 'name', 'name_kr', 'menu_image', 'slug','meta_title'], 'string', 'max' => 255],
            [[  'meta_description', 'meta_keywords','menu_image','image'], 'string'],
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] =
            [
                'class' => CyrillicSlugBehavior::class,
                'attribute' => 'name',
                'slugAttribute' => "slug"
            ];
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

    /**
     * {@inheritdoc}
     */

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'root' => Yii::t('app', 'Root'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'lvl' => Yii::t('app', 'Lvl'),
            'name_uz' => Yii::t('app', 'Name Uz'),
            'name' => Yii::t('app', 'Name Ru'),
            'name_kr' => Yii::t('app', 'Name Kr'),
            'status' => Yii::t('app', 'Status'),
            'icon' => Yii::t('app', 'Icon'),
            'icon_type' => Yii::t('app', 'Icon Type'),
            'active' => Yii::t('app', 'Active'),
            'selected' => Yii::t('app', 'Selected'),
            'slug' => Yii::t('app', 'Slug'),
            'sub_items' => Yii::t('app', 'SubItems'),
            'disabled' => Yii::t('app', 'Disabled'),
            'readonly' => Yii::t('app', 'Readonly'),
            'visible' => Yii::t('app', 'Visible'),
            'collapsed' => Yii::t('app', 'Collapsed'),
            'movable_u' => Yii::t('app', 'Movable U'),
            'movable_d' => Yii::t('app', 'Movable D'),
            'movable_l' => Yii::t('app', 'Movable L'),
            'movable_r' => Yii::t('app', 'Movable R'),
            'removable' => Yii::t('app', 'Removable'),
            'removable_all' => Yii::t('app', 'Removable All'),
            'child_allowed' => Yii::t('app', 'Child Allowed'),
            'position' => Yii::t('app','Position'),
            'image' => Yii::t('app', 'Image'),
            'menu_image' => Yii::t('app', 'Image'),
        ];
    }

    public static function find()
    {
        $query = new MultilingualQuery(get_called_class());
        return $query->multilingual()->with('translations');
    }

    public static function mainCategories($lang)
    {
        Yii::$app->language = $lang;
        return Yii::$app->db->cache(function ($db) {
            return Category::find()
                ->where(['root' => 1, 'lvl' => 1])
                ->andWhere(['=', 'status', 1])
                ->all();
        });
    }

    public static function allCategories($lang)
    {
        if ($lang == 'ru') {
            return Category::find()
                ->select(['id', 'name', 'image', 'menu_image', 'lvl', 'rgt', 'lft', 'root'])
                ->where(['!=', 'lvl', 0])
                ->andWhere(['=', 'status', 1])
                ->asArray()
                ->all();
        }

        return Category::find()
            ->select(['id', "name_{$lang} as name", 'image', 'menu_image', 'lvl', 'rgt', 'lft', 'root'])
            ->where(['!=', 'lvl', 0])
            ->andWhere(['=', 'status', 1])
            ->asArray()
            ->all();
    }

    public static function apiCategories($lang)
    {
        $categories = [];
        foreach (Category::allCategories($lang) as $category) {
            $parent = Category::getParent($category);
            $temp_category = array_merge([], $category);
            $temp_category['parent'] = $parent == 1 ? 0 : $parent;
            $categories[] = $temp_category;
        }
        return $categories;
    }



    public static function getParent($model)
    {

        $lvl = $model['lvl'] - 1;
        $rgt = $model['rgt'];
        $lft = $model['lft'];
        $root = 1;

        $cat = Category::find()
            ->where(['root' => $root, 'lvl' => $lvl])
            ->andWhere(['<', 'lft', $lft])
            ->andWhere(['>', 'rgt', $rgt])
            ->one();
        return $cat->id;
    }

    public static function fullCategory($lang)
    {
        $mainCategories = Category::mainCategories($lang);
        $fullCategories = [];

        foreach ($mainCategories as $category) {
            $temp_category1 = [];
            $temp_category1['id'] = $category->id;
            $temp_category1['name'] = $category->name;
            $temp_category1['image'] = $category->image;
            $temp_category1['menu_image'] = $category->menu_image;
            $temp_sub1 = [];
            foreach (Category::findSubCategories($category, $lang) as $cat) {
                $temp_category2 = [];
                $temp_category2['id'] = $cat['id'];
                $temp_category2['name'] = $cat['name'];
                $temp_category2['image'] = $cat['image'];
                $temp_category2['menu_image'] = $cat['menu_image'];
                $temp_sub2 = [];
                foreach (Category::findSubCategories($cat, $lang) as $cat1) {
                    $temp_category3 = [];
                    $temp_category3['id'] = $cat1['id'];
                    $temp_category3['name'] = $cat1['name'];
                    $temp_category3['image'] = $cat1['image'];
                    $temp_category3['menu_image'] = $cat1['menu_image'];
                    $temp_sub2[] = $temp_category3;
                }

                $temp_category2['sub_items'] = $temp_sub2;

                $temp_sub1[] = $temp_category2;
            }
            $temp_category1['sub_items'] = $temp_sub1;
            $fullCategories[] = $temp_category1;
        }
        return $fullCategories;
    }

    public static function findSubCategories($category, $lang)
    {
        Yii::$app->language = $lang;
        $lvl = $category->lvl + 1;
        $rgt = $category->rgt;
        $lft = $category->lft;
        $root = 1;

        return Category::find()
            ->andWhere(['=', 'lvl', $lvl])
            ->andWhere(['=', 'root', $root])
            ->andWhere(['>', 'lft', $lft])
            ->andWhere(['<', 'rgt', $rgt])
            ->andWhere(['=', 'status', 1])
            ->all();

    }

    public static function listSubCategories($category_id, $lang)
    {
        $model = Category::findOne($category_id);
        return Category::findSubCategories($model, $lang);
    }

    public function getTitle()
    {
        $lang = Yii::$app->language;
        switch ($lang) {
            case 'uz' :
                return $this->name_uz;
            case 'kr' :
                return $this->name_kr;
            default:
                return $this->name;
        }
    }

    public function getMainImage()
    {
        $image = $this->lvl == 1 ? $this->menu_image : $this->image;
        return $image == "" ? "https://via.placeholder.com/200?text=NO%20PHOTO" : $image;
    }

}