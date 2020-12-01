<?php


namespace frontend\models;

use Yii;

class FastOrder extends \yii\base\Model
{

    public $name;
    public $tel;
    public $product_id;
    public $count;
    public $code;

    public function rules()
    {
        return [

            [['name', 'tel'], 'string'],
            [['name', 'tel'], 'required'],
            ['code', 'required', 'on' => 'verifyPhoneNumber'],
            ['code', 'integer'],
            [['product_id', 'count'], 'integer'],

        ];
    }

    public function attributeHints()
    {
        return [
            'code' => t('Enter the code sent to your phone number')
        ];
    }

    public function scenarios()
    {
        return array_merge(parent::scenarios(), [
            'verifyPhoneNumber' => ['name', 'tel', 'code', 'product_id', 'count'],
        ]);
    }


    public function getClearedTel()
    {
        $tel = trim($this->tel);
        return strtr($tel, [
            " " => '',
            "(" => '',
            ")" => '',
            "-" => '',
        ]);
    }


    public function attributeLabels()
    {
        return [
            'name' => t('FIO'),
            'code' => t('Code'),
            'tel' => t('Phone'),
        ];
    }


    public function sendCodeViaSms()
    {

        $session = Yii::$app->session;
        $code = mt_rand(10000, 99999);
        $session->set('fastOrderVerifyCode', $code);
        $session->set('fastOrderVerifyCodeTime', time());
        $phoneNumber = Yii::$app->help->clearPhoneNumber($this->tel);
        $message = Yii::t('app', 'Verification code on {hostInfo}: {code}', [
            'hostInfo' => Yii::$app->request->hostInfo,
            'code' => $code,
        ]);

        return Yii::$app->sms->sendMessage($phoneNumber, $message);
    }

    public function checkCode()
    {
        return $this->code == Yii::$app->session->get('fastOrderVerifyCode');
    }

    public function saveTempUser()
    {
        Yii::$app->session->set('tempUserName', $this->name);
        Yii::$app->session->set('tempUserTel', $this->tel);
    }

    public function acceptOrder()
    {

        $product = Product::findOne($this->product_id);
        if ($product != null){
            $product->order_count = intval($product->order_count)  + 1;
            $product->save();
        }
        return true;
    }

    public function getUserName()
    {
        if (!Yii::$app->user->isGuest) {
            return Yii::$app->user->identity->name;
        }
        return Yii::$app->session->get('tempUserName');
    }

    public function getUserPhoneNumber()
    {
        if (!Yii::$app->user->isGuest) {
            return Yii::$app->user->identity->username;
        }
        return Yii::$app->session->get('tempUserTel',"");
    }

    public function loadDefaultValues($productId)
    {
        $this->name = $this->getUserName();
        $this->tel = $this->getUserPhoneNumber();
        $this->count = 1;
        $this->product_id = $productId;
    }

    public function getIsTempUser()
    {
        if (Yii::$app->session->has('tempUserTel')) {
            return $this->tel === Yii::$app->session->get('tempUserTel');
        }
        return false;
    }
}