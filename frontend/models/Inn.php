<?php


namespace frontend\models;


use yii\base\Model;

class Inn extends Model
{

    public $inn;
    public $phone;
    public $code;
    public $data;
    public $email;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [

            [['inn'], 'integer',],
            ['code', 'safe'],
            ['data', 'safe'],
            ['code', 'number'],
            ['phone', 'string'],
            ['email', 'string'],
            ['password', 'string'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],

        ];
    }

    public function attributes()
    {
        return [
            'inn' => \Yii::t('app', 'Inn'),
            'phone' => \Yii::t('app', 'Phone'),
            'data' => \Yii::t('app', 'Data'),
            'code' => \Yii::t('app', 'Verify Code')
        ];
    }


    public function clearData()
    {
        \Yii::$app->session->remove('verifyInnPhoneNumber');
        \Yii::$app->session->remove('verifyInnPhoneCode');
        \Yii::$app->session->remove('verifyInnPhonetime');
        \Yii::$app->session->remove('innNumber');
        \Yii::$app->session->remove('smsInnSended');
        \Yii::$app->session->remove('tempUserInnVerified');
    }

//
    public function saveDataToSession($code)
    {
        \Yii::$app->session->set('verifyInnPhoneNumber', $this->phone);
        \Yii::$app->session->set('verifyInnPhoneCode', $code);
        \Yii::$app->session->set('smsInnSended', true);
        \Yii::$app->session->set('verifyInnPhonetime', date('U'));
    }

    public function sendVerifyCode()
    {
        if ($this->isExpired()) {
            $code = mt_rand(10000, 99999);

            $message = \Yii::t('app', 'Reset code of your account on {hostInfo}: Verify code: {code}', [
                'hostInfo' => \Yii::$app->request->hostInfo,
                'code' => $code,
            ]);

            if (\Yii::$app->sms->sendMessage($this->phone, $message)) {
                $this->saveDataToSession($code);
                return true;
            } else {
                $this->addError('phone', \Yii::t('app', 'Phone Number is error'));
                return false;
            }
        }

        $this->addError('code', t('Code already Send!'));
        return false;

    }

    public function validateCode()
    {
        if (!$this->isExpired()) {
            if ($this->getVerifyCode() == $this->code) {
                return true;
            } else {
                $this->addError('code', \Yii::t('app', 'Code Error'));
                return false;
            }
        } else {
            $this->addError('code', \Yii::t('app', 'Code Expired'));
            return false;
        }

    }

    public function isExpired()
    {
        return (date('U') - \Yii::$app->session->get('verifyInnPhonetime')) > 120;

    }

    public function getVerifyCode()
    {
        return \Yii::$app->session->get('verifyInnPhoneCode');
    }

    public function getPhoneFromSession()
    {
        return \Yii::$app->session->get('verifyInnPhoneNumber');
    }

    public function getInn()
    {
        return \Yii::$app->session->get('inn');
    }
//
//    public function isAlreadySend()
//    {
//    }
//
    public function setInn()
    {
        \Yii::$app->session->set('inn', $this->inn);
    }


}