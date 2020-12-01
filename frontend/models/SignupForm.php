<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $full_name;
    public $phone;
    public $phone_verification;
    public $birth_date;
    public $passport;
    public $passport_date_of_issue;
    public $passport_date_of_expiry;
    public $passport_authority;
    public $inn;

    public $region_id;
    public $town_id;
    public $address;
    public $gender;
    public $work;
    public $kpp;
    public $company_name;
    public $ogrn;
    public $bik;
    public $account_number;
    public $email;
    public $password;
    public $verifyCode;
    // extra vars in order to gather firs_name and last_name
    public $first_name;
    public $middle_name;
    public $last_name;
    public $password_repeat;

    public $reCaptcha;


    protected $_formName;

    public function formName()
    {
        return $this->_formName ?: parent::formName();
    }

    public function setFormName($name)
    {
        $this->_formName = $name;
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'string'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],

            ['full_name', 'string'],
            ['phone', 'string'],
            ['phone', 'required'],
            ['birth_date', 'string'],
            ['passport', 'string'],
            ['passport_date_of_issue', 'string'],
            ['passport_date_of_expiry', 'string'],
            ['passport_authority', 'string'],
            ['inn', 'integer'],
            ['gender', 'integer'],
            ['gender', 'required'],
            ['region_id', 'integer'],
            ['town_id', 'integer'],
            ['address', 'string'],
            ['work', 'string'],
            ['kpp', 'string'],
            ['company_name', 'string'],
            ['ogrn', 'string'],
            ['bik', 'string'],
            ['account_number', 'integer'],
            ['phone_verification', 'safe'],
            // ['verifyCode', 'captcha'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 5],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
            [['password_repeat'], 'required'],
            [['first_name', 'last_name', 'middle_name'], 'string'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::class,
//                'secret' => '6Ld0P8UZAAAAAPzzjfHR-ADhoHS9sg-s-aa4VBG8', // unnecessary if reСaptcha is already configured
                'uncheckedMessage' => 'Please confirm that you are not a bot.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = User::STATUS_ACTIVE;

//        #==================================================#
//        $user->guid = "GUID" . $user->username;/
//        #==================================================#


        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $user->phone = Yii::$app->help->clearPhoneNumber($this->phone);
        $user->address = $this->address;
        $user->gender = $this->gender;
        $user->birth_date = $this->birth_date;
        $user->name = $this->last_name;
        $user->surname = $this->first_name;
        $user->father_name = $this->middle_name;


        $res = Yii::$app->c1->signup([
            "fullname" => $this->last_name . " " . $this->first_name . " " . $this->middle_name . " ",
            "user_type" => 1,
            "inn" => $this->inn,
            "phone" => Yii::$app->help->clearPhoneNumber($this->phone),
            "email" => $this->email,
            "gender" => (integer)$this->gender,
            "adress" => $this->address,
        ]);


        if ($res) {
            if ($res->data['info']) {
                $user->guid = $res->data['info'];
            } else {
                return false;
            }
        }


//        $this->sendSms($user);
        if (!$user->save()) {
            dd($user->errors);
        } else {
            return true;
        }
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

    public function attributeLabels()
    {
        return [
            'email' => t('Email'),
            'address' => t('Address'),
            'gender' => t('Gender')
        ];
    }

    protected function sendSms($user)
    {
        $message = Yii::t('app', 'Activation code of your account on {hostInfo}: {code}', [
            'hostInfo' => Yii::$app->request->hostInfo,
            'code' => $user->phone_verification,
        ]);
        Yii::$app->sms->sendMessage($user->username, $message);
    }
}
