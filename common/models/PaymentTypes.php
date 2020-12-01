<?php

namespace common\models;

use soft\db\SActiveQuery;
use soft\db\SActiveRecord;
use Yii;

class PaymentTypes extends SActiveRecord
{
    public static function tableName()
    {
        return 'payment_types';
    }

    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            ['name', 'string', 'max' => 255],
            ['name_ru', 'required'],
        ];
    }

    public function setAttributeNames()
    {
        return [
            'createdByAttribute' => false,
            'multilingualAttributes' => ['name'],
            'deletedAttribute' => false,

        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function find()
    {
        $query = new SActiveQuery(get_called_class());
        return $query->multilingual();
    }


}
