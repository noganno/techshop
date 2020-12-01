<?php


namespace api\modules\v1\models;

use frontend\models\Product;
use yii;
use yii\base\Model;

class FastOrder extends Model
{
    public $name;
    public $phone;
    public $product_id;
    public $count;

    public function rules()
    {
        return [
            [['name', 'phone', 'product_id', 'count'], 'required'],
            [['name', 'phone'], 'string'],
            ['phone', 'match', 'pattern' => '/\+998\d{9}/', 'message' => Yii::t('app', 'Incorrect phone number')],
            [['product_id', 'count'], 'integer'],
            ['product_id', 'hasProduct']
        ];
    }


    public function hasProduct($attribute, $params)
    {
        if (Product::findOne($this->product_id)) {
            return true;
        } else {
            $this->addError($attribute, Yii::t('app', 'Product not found'));
        }
    }

    public function sendMail()
    {
        return 1;
    }
}