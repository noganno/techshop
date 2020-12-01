<?php

namespace frontend\models;

use Yii;
use common\models\User;
use yii\base\InvalidArgumentException;
use yii\base\Model;

/**
 * Telefon raqami orqali parolni reset qilish
 */
class ResetPasswordPhoneForm extends Model
{
    public $reCaptcha;
    public $code;
    public $phone;
    public $password;
    public $password_repeat;

    private $_customer;

    public function rules()
    {
        return [
            ['phone', 'required', 'message' => t('This field is required.'),],
            ['phone', 'match', 'pattern' => '/\+998 \(\d{2}\) \d{3}\-\d{2}\-\d{2}/', 'message' => t('Incorrect phone number')],
            ['phone', 'string'],

            ['code', 'required','message' => t('This field is required.'),],
            ['code', 'integer', 'message' =>t('Value must be an integer.')],

            [['password', 'password_repeat'], 'required', 'message' => t('This field is required.'),],
            [['password'], 'string', 'min' => 5,
                'message' => t('Password should contain at least 5 characters'),
                'tooShort' => t('Password should contain at least 5 characters'),
            ],

            ['password_repeat', 'compare', 'compareAttribute' => 'password',  'message' => t('The re-entered password does not match')],

            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::class,
                'uncheckedMessage' => 'Please confirm that you are not a bot.'],
        ];
    }

    public function attributeLabels()

    {

        return [
            'code' => t('Enter the code sent to your phone number'),
            'password' => t('New password'),
            'password_repeat' => t('Repeat new password'),
            'phone' => t('Your phone number'),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['requestResetPassword'] = ['phone', 'reCaptcha'];
        $scenarios['setNewPassword'] = ['code', 'password', 'password_repeat', 'reCaptcha'];
        return $scenarios;
    }

    //<editor-fold desc="Request reset password" defaultstate="collapsed">

    public function findUserByPhone()
    {
        return User::findOne(['phone' => $this->getClearPhoneNumber()]);
    }

    public function getClearPhoneNumber()
    {
        return Yii::$app->help->clearPhoneNumber($this->phone);
    }

    public function checkUser()
    {

        if (!$this->validate()){
            return false;
        }

        $user = $this->findUserByPhone();
        if ($user == null){
            $this->addError('phone', t('Phone number not found'));
            return false;
        }
        else{

            $code = mt_rand(100000, 999999);

            if ($this->sendCode($code)){

                Yii::$app->session->set('_resetUserId', $user->id);
                Yii::$app->session->set('_resetUserCode', $code);
                return true;

            }
            else{
                $this->addError('phone', t('An error occured while sending reset code to your phone number'));
                return false;
            }

        }

    }

    private function sendCode($code)
    {
        $message = Yii::$app->request->hostInfo ."\n". t('Code for reset password').": ".$code;
        return Yii::$app->sms->sendMessage($this->getClearPhoneNumber(), $message);
    }

    // </editor-fold>


}
