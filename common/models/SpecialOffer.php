<?php

namespace common\models;

use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualQuery;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%special_offer}}".
 *
 * @property int $id
 * @property int|null $category_id
 * @property string|null $image
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property SpecialOfferLang[] $specialOfferLangs
 */
class SpecialOffer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%special_offer}}';
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
            [['category_id', 'created_at', 'updated_at'], 'integer'],
            [['image','title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'image' => Yii::t('app', 'Image'),
            'title' => Yii::t('app', 'Title'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[SpecialOfferLangs]].
     *
     * @return \yii\db\ActiveQuery
     */


    public function getCategory()
    {
        return $this->hasOne(\frontend\models\Category::className(),['id'=>'category_id']);
    }


    public static function find()
    {
        $query = new MultilingualQuery(get_called_class());
        return $query->multilingual();
    }

    public function getSpecialOfferLangs()
    {
        return $this->hasMany(SpecialOfferLang::className(), ['owner_id' => 'id']);
    }
}
