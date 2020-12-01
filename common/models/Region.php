<?php

namespace common\models;

use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string|null $slug
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property RegionLang[] $regionLangs
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */

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
                    'name',
                ]
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name_ru',
            ],
            [
                'class' => TimestampBehavior::className(),
            ]
        ];
    }

    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['slug'], 'string', 'max' => 127],
            [['name'], 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'name' => Yii::t('app', 'Name')
        ];
    }

    /**
     * Gets query for [[RegionLangs]].
     *
     * @return \yii\db\ActiveQuery
     */

    public static function find()
    {
        $query = new MultilingualQuery(get_called_class());
        return $query->multilingual();
    }

    public function getSklads()
    {
        return $this->hasMany(Sklad::class, ['region_id' => 'id']);
    }

    public function getRegionLangs()
    {
        return $this->hasMany(RegionLang::className(), ['owner_id' => 'id']);
    }
}
