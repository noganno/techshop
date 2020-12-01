<?php

namespace common\models;

use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order_status".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $status
 * @property int|null $type
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property OrderStatusLang[] $orderStatusLangs
 */
class OrderStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_status';
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
                'class' => SluggableBehavior::className(),
                'attribute' => 'title_ru',
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
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['slug'], 'string', 'max' => 127],
            [['status'], 'string', 'max' => 255],
            [['title'], 'string']
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
            'status' => Yii::t('app', 'Status'),
            'type' => Yii::t('app', 'Type'),
            'title' => Yii::t('app', 'Title'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[OrderStatusLangs]].
     *
     * @return \yii\db\ActiveQuery
     */

    public static function find()
    {
        $query = new MultilingualQuery(get_called_class());
        return $query->multilingual();
    }

}
