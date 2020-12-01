<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class LegalSignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $inn;
    public $company_name;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            [['inn', 'company_name'], 'string'],
            ['inn', 'checkInn'],
            [['inn', 'company_name'], 'required'],
            ['inn', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This inn has already been taken.'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
            [['password_repeat'], 'required'],
            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['passwordMinLength']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = User::STATUS_INACTIVE;
        $user->company_name = $this->company_name;
        $user->inn = $this->inn;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        Yii::$app->name = "Texnomart";

        $mail = new Yii::$app->emailer();
        $mail->setFrom("isxoqjon_7710@mail.ru");
        $mail->setTo($user->email);
        $mail->setName(Yii::$app->name);
        $mail->setSubject("Texnomart");
        $mail->setHtml(Yii::$app->view->renderAjax("@frontend/views/mail/html", [
            'user' => $user
        ]));
        return $mail->sendMail();
    }

    public function attributeLabels()
    {
        return [
            'username' => t('Username'),
            'inn' => t('Inn'),
            'email' => t('Email'),
            'company_name' => t('Company Name'),
            'password' => t('Password'),
            'password_repeat' => t('Password Repeat'),
        ];
    }

    public function checkInn()
    {
        if (!Yii::$app->c1->checkInn($this->inn)) {
            $this->addError('inn', t("Already taken"));
        }
    }
}