<?php

namespace common\models;

use soft\db\SActiveRecord;
use Yii;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use yeesoft\multilingual\db\MultilingualQuery;

/**
 * This is the model class for table "{{%attribute_group}}".
 *
 * @property int $id
 * @property int|null $sort_order
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property AttributeGroupLang[] $attributeGroupLangs
 */
class AttributeGroup extends SActiveRecord
{
    use MultilingualLabelsTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%attribute_group}}';
    }

    public function behaviors()
    {
        return [
            'multilingual' => [
                'class' => MultilingualBehavior::className(),
                'languages' => [
                    'uz' => "O'zbekcha",
                    'kr' => 'Ўзбекча',
                    'ru' => "Русский"
                ],
                'attributes' => [
                    'title',
                ]
            ],
            [
                'class' => yii\behaviors\TimestampBehavior::className(),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['title', 'string'],
            ['title', 'required'],
            [['sort_order', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function find()
    {
        $query = new MultilingualQuery(get_called_class());
        return $query->multilingual();
    }


    public function deleteConditions()
    {
        return $this->id != 2;
    }


    public function getAttributesNames()
    {
        return $this->hasMany(Attribute::class, ['attribute_group_id' => 'id'])
            ->andWhere(['status' => 1])
            ->joinWith('translations')
            ->andWhere(['attribute_lang.language' => Yii::$app->language])
            ;
    }

    public function getProductAttributes()
    {
        return $this->hasMany(ProductAttribute::class, ['attribute_id' => 'id'])
            ->andWhere(['language' => Yii::$app->language])
            ->via('attributesNames')
            ;
    }
}
