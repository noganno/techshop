<?php


namespace frontend\models;

use yii;
use yii\base\Model;

class Phone extends Model
{

    public $username;
    public $code;

    public function rules()
    {
        return [

            ['code', 'safe'],
            ['code', 'number'],
            ['username', 'trim'],
            ['username', 'hasIn1C'],
            ['username', 'required'],
            ['username', 'string'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => \Yii::t('app', 'This phone has already been taken.')],

        ];
    }

    public function attributes()
    {
        return [
            'phone' => \Yii::t('app', 'Phone'),
            'code' => \Yii::t('app', 'Verify Code')
        ];
    }


    public function clearData()
    {
        \Yii::$app->session->remove('verifyPhoneNumber');
        \Yii::$app->session->remove('verifyPhoneCode');
        \Yii::$app->session->remove('verifyPhonetime');
        \Yii::$app->session->remove('smsSended');
        \Yii::$app->session->remove('tempUserVerified');
    }

    public function saveDataToSession($code)
    {
        \Yii::$app->session->set('verifyPhoneNumber', $this->username);
        \Yii::$app->session->set('verifyPhoneCode', $code);
        \Yii::$app->session->set('verifyPhonetime', date('U'));
    }

    public function sendVerifyCode()
    {
        $code = mt_rand(10000, 99999);

        $message = \Yii::t('app', 'Activation code of your account on {hostInfo}: {code}', [
            'hostInfo' => \Yii::$app->request->hostInfo,
            'code' => $code,
        ]);

        if (\Yii::$app->sms->sendMessage(Yii::$app->help->clearPhoneNumber($this->username), $message)) {
            $this->saveDataToSession($code);
            return true;
        } else {
            $this->addError('username', \Yii::t('app', 'Phone Number is error'));
            return false;
        }

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
        return (date('U') - \Yii::$app->session->get('verifyPhonetime')) > 120;

    }


    public function getVerifyCode()
    {
        return \Yii::$app->session->get('verifyPhoneCode');
    }

    public function getPhoneFromSession()
    {
        return \Yii::$app->session->get('verifyPhoneNumber');
    }

    public function isAlreadySend()
    {
    }

    public function setVerifyCode()
    {
        \Yii::$app->session->set('verifyPhoneCode', mt_rand(10000, 99999));
    }


    public function attributeLabels()
    {
        return [
            'code' => t('Code')
        ];
    }

    public function hasIn1C()
    {
        if (!Yii::$app->c1->checkPhone(Yii::$app->help->clearPhoneNumber($this->username))) {
            $this->addError('username', t("Already taken"));
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Your title',
                    'text' => 'Your message',
                    'confirmButtonText' => 'Done!',
                ]
            ]);
        }
    }
}