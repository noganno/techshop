<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "credit_types".
 *
 * @property int $id
 * @property string $name
 * @property int|null $status
 * @property int|null $bank
 *
 * @property CreditTypesOptions[] $creditTypesOptions
 */
class CreditTypes extends \soft\db\SActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'credit_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'bank'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'bank' => Yii::t('app', 'Bank'),
        ];
    }

    /**
     * Gets query for [[CreditTypesOptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreditTypesOptions()
    {
        return $this->hasMany(CreditTypesOptions::className(), ['credit_type_id' => 'id']);
    }
}
