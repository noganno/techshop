<?php

namespace common\models;

use soft\db\SActiveRecord;
use Yii;

use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use yeesoft\multilingual\db\MultilingualQuery;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;


/**
 * This is the model class for table "{{%attribute}}".
 *
 * @property int $id
 * @property int|null $attribute_group_id
 * @property int|null $sort_order
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property AttributeLang[] $attributeLangs
 */
class Attribute extends SActiveRecord
{
    public $categoryIds;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%attribute}}';
    }

    public function behaviors()
    {
        return [
            'multilingual' => [
                'class' => MultilingualBehavior::className(),
                'languages' => [
                    'kr' => 'Ўзбекча',
                    'uz' => "O'zbekcha",
                    'ru' => "Русский"
                ],
                'attributes' => [
                    'title',
                ]
            ],
            [
                'class' => TimestampBehavior::className(),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string'],
            [['attribute_group_id', 'sort_order', 'created_at', 'updated_at', 'filter', 'status'], 'integer'],
            ['categoryIds', 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'attribute_group_id' => Yii::t('app', 'Attribute Group'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'filter' => Yii::t('app', 'Show in filter'),
            'title' => Yii::t('app', 'Nomi'),
            'status' => Yii::t('app', 'Status'),
            'categoryIds'      => Yii::t('app', 'Categories'),

        ];
    }

    public function getCategoryList()
    {
        return Html::ul($this->categories, ['item' => function ($item) {

            return Html::tag('li', $item->title);

        }]);
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('attribute_to_category', ['attribute_id' => 'id']);
    }


    public static function find()
    {
        $query = new MultilingualQuery(get_called_class());
        return $query->multilingual();
    }

    public function getAttributeGroup()
    {
        return $this->hasOne(AttributeGroup::class, ['id' => 'attribute_group_id']);
    }

    public function getProductAttributes()
    {
        return $this->hasMany(ProductAttribute::class, ['attribute_id' => 'id']);
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['set-category'] = ['categoryIds'];
        return $scenarios;
    }


}
