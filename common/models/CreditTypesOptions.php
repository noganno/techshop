<?php

namespace common\models;

use soft\service\InputType;
use Yii;

class CreditTypesOptions extends \soft\db\SActiveRecord
{
    public static function tableName()
    {
        return 'credit_types_options';
    }

    public function rules()
    {
        return [
            [['credit_type_id', 'month'], 'integer'],
            ['credit_type_id', 'required'],
            [['deposit', 'foiz'], 'number'],
            [['credit_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CreditTypes::className(), 'targetAttribute' => ['credit_type_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'credit_type_id' => Yii::t('app', 'Credit Type ID'),
            'month' => Yii::t('app', 'Month'),
            'deposit' => Yii::t('app', 'Deposit'),
            'foiz' => Yii::t('app', 'Foiz'),
        ];
    }


    public function getCreditType()
    {
        return $this->hasOne(CreditTypes::className(), ['id' => 'credit_type_id']);
    }

    public function getModelConfigs()
    {
        return [
            'credit_type_id' => [
                'inputType' => InputType::SELECT2,
                'options' => ['options' => ['placeholder' => "Tanlang..."]],
            ],
        ];

    }


}
