<?php


namespace frontend\models;

use yii;
use yii\base\Model;

class Reset extends Model
{

    public $username;
    public $code;
    public $password;
    public $password_repeat;
    public $reCaptcha;


    public function rules()
    {
        return [
            ['username', 'safe'],
            ['username', 'required'],
            ['username', 'string'],
            ['username', 'hasUsername'],
            [['code'], 'integer', 'max' => 5],
            ['code', 'required'],
            ['code', 'required'],

            [['password_repeat'], 'compare', 'compareAttribute' => 'password', 'message' => t("Passwords don't match")],
            ['password_repeat', 'required'],
            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['passwordMinLength']],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::class,
//                'secret' => '6Ld0P8UZAAAAAPzzjfHR-ADhoHS9sg-s-aa4VBG8', // unnecessary if reСaptcha is already configured
                'uncheckedMessage' => 'Please confirm that you are not a bot.'],
        ];
    }

    public function scenarios()
    {
        $scenario = parent::scenarios();
        $scenario['captcha'] = ['reCaptcha', 'username'];
        $scenario['verify'] = ['username', 'code'];
        $scenario['new_password'] = ['password', 'password_repeat'];
        return $scenario;
    }

    public function sendCode()
    {
        $user = \common\models\User::findOne(['username' => $this->username]);
        if ($user) {
            if ($user->user_type == 1) {

                $code = mt_rand(10000, 99999);
                $message = Yii::t('app', 'Reset code of your account on {hostInfo}: {code}', [
                    'hostInfo' => Yii::$app->request->hostInfo,
                    'code' => $user->phone,
                ]);
                if (Yii::$app->sms->sendMessage($user->username, $message)) {

                    Yii::$app->session->set('resetUsername', $user->username);
                    Yii::$app->session->set('resetCode', $user->code);
                    return true;

                } else {
                    return false;
                }


            } elseif ($user->user_type == 2) {

            } else {

            }
        }
    }


    public function hasUsername()
    {
        $user = \common\models\User::findOne(['username' => $this->username, 'status' => User::STATUS_ACTIVE]);
        if ($user) {
            return true;
        } else {
            $this->addError('username', t('User not registered'));
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_WARNING, [
                [
                    'title' => t('You have not registered'),
                    'text' => t('not_registered_message'),
                    'footer' => yii\helpers\Html::a(t('Register'), ['user/register']),
                    'confirmButtonText' => 'OK',
                ]
            ]);
            return false;
        }
    }

}