<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%legal_orders}}".
 *
 * @property int $id
 * @property string|null $fio
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $company_name
 * @property string|null $product_info
 */
class LegalOrders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $reCaptcha;

    public static function tableName()
    {
        return '{{%legal_orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inn'], 'required'],
            [['fio'], 'required'],
            [['inn'], 'string', 'max' => 50],
            [['fio', 'phone', 'email', 'company_name', 'product_info'], 'string', 'max' => 255],
//            [['reCaptcha'],'required'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::class,
                'secret' => '6Le5QcUZAAAAADZZAI3Xk9YUDgczHXLD1dYtLTMT', // unnecessary if reСaptcha is already configured
                'uncheckedMessage' => 'Please confirm that you are not a bot.'],
//            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fio' => Yii::t('app', 'Fio'),
            'inn' => Yii::t('app', 'Inn'),
            'phone' => Yii::t('app', 'Phone'),
            'status' => Yii::t('app', 'Status'),
            'email' => Yii::t('app', 'Email'),
            'company_name' => Yii::t('app', 'Company Name'),
            'product_info' => Yii::t('app', 'Product Info'),
        ];
    }

    public function getOrderStatus()
    {
        return $this->hasOne(OrderStatus::className(), ['id' => 'status']);
    }


}
