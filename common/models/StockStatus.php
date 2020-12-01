<?php

namespace common\models;

use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "stock_status".
 *
 * @property int $id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property StockStatusLang[] $stockStatusLangs
 */
class StockStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_status';
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
                'class' => TimestampBehavior::className(),
            ]
        ];
    }

    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
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
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'name' => Yii::t('app', 'Name')
        ];
    }

    /**
     * Gets query for [[StockStatusLangs]].
     *
     * @return \yii\db\ActiveQuery
     */

    public static function find()
    {
        $query = new MultilingualQuery(get_called_class());
        return $query->multilingual();
    }

    public function getStockStatusLangs()
    {
        return $this->hasMany(StockStatusLang::className(), ['owner_id' => 'id']);
    }
}
