<?php

namespace backend\models;

use soft\db\SActiveQuery;
use Yii;

class Country extends \soft\db\SActiveRecord
{

    public static function tableName()
    {
        return '{{%country}}';
    }

    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            ['name', 'string', 'max' => 255],
            ['name', 'required'],
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

    public static function find()
    {
       $query = new SActiveQuery(get_called_class());
       return $query->multilingual();
    }


}
