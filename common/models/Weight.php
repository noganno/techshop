<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "weight".
 *
 * @property int $id
 * @property string|null $unit
 * @property float|null $value
 */
class Weight extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weight';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'number'],
            [['unit'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'unit' => Yii::t('app', 'Unit'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
}
