<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_to_sklad".
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $sklad_id
 * @property int|null $quantity
 *
 * @property Product $product
 * @property Sklad $sklad
 */
class ProductToSklad extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'product_to_sklad';
    }


    public function rules()
    {
        return [

            [['product_id', 'sklad_id'], 'integer'],
            [['product_id', 'sklad_id'], 'unique', 'targetAttribute' => ['product_id', 'sklad_id']],
            [['quantity'], 'integer', 'min' => 0],
            [['product_id', 'sklad_id', 'quantity'], 'required'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['sklad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sklad::className(), 'targetAttribute' => ['sklad_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product'),
            'sklad_id' => Yii::t('app', 'Sklad'),
            'quantity' => Yii::t('app', 'Quantity'),
        ];
    }


    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }


    public function getSklad()
    {
        return $this->hasOne(Sklad::className(), ['id' => 'sklad_id']);
    }
}
