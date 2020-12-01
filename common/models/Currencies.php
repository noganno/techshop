<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "currencies".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $symbol_left
 * @property string|null $symbol_right
 * @property float|null $value
 * @property int|null $status
 * @property int|null $date_modified
 */
class Currencies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currencies';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return  [
            'class'=>yii\behaviors\TimestampBehavior::className(),
        ];    
    }

    public function rules()
    {
        return [
            [['value'], 'number'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['code'], 'string', 'max' => 5],
            [['symbol_left', 'symbol_right'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'symbol_left' => Yii::t('app', 'Symbol Left'),
            'symbol_right' => Yii::t('app', 'Symbol Right'),
            'value' => Yii::t('app', 'Value'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
