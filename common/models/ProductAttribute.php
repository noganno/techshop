<?php

namespace common\models;

use Yii;

class ProductAttribute extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%product_attribute}}';
    }

    public function rules()
    {
        return [

            ['product_id', 'unique', 'targetAttribute' => ['product_id', 'attribute_id','language' ]],

            [['product_id', 'attribute_id'], 'integer'],
            [['language'], 'string', 'max' => 5],
            [['text'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'attribute_id' => Yii::t('app', 'Attribute ID'),
            'language' => Yii::t('app', 'Language'),
            'text' => Yii::t('app', 'Text'),
        ];
    }

    public function getAttributeName()
    {
        return $this->hasOne(Attribute::className(), ['id' => 'attribute_id']);
    }

    public function getAttributeGroup()
    {
        return $this->hasOne(AttributeGroup::class, ['id' => 'attribute_group_id'])
            ->via('attributeName');
    }

    public static function primaryKey()
      {
          return ["product_id"];
      }
      
}
