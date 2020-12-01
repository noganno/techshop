<?php

namespace api\modules\v1\controllers;

use common\models\LoginForm;
use common\models\User;
use frontend\models\SignupForm;
use Yii;
use yii\base\Controller;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;

class SiteController extends Controller
{

    public $language = 'ru';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'signup' => ['post'],
                    'verify-phone' => ['post'],
                    'login' => ['post']
                ],
            ],
        ];
    }

    public function actions()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//        if (Yii::$app->request->post('lang')) {
//            $this->language = Yii::$app->request->post('lang');
//        }
//        Yii::$app->language = $this->language;
    }
    // public function actionError()
    // {
    //     $exception = Yii::$app->errorHandler->exception;
    //     if ($exception !== null) {
    //         return $exception;
    //     }
    // }


    public function actionRequestResetPassword()
    {
        Yii::$app->language = Yii::$app->request->get('lang');
        $phone = Yii::$app->request->post('phone');
        $user = User::findOne(['username' => $phone]);

        if (!$user) {
            Yii::$app->response->statusCode = 404;
            return [
                'status' => false,
                'code' => 123,
                'message' => Yii::t('app', 'User not found')
            ];
        } else {
            if ($user->canSendVerifyCode()) {

                $user->generatePhoneVerifyCode();
                $user->save();

                $message = Yii::t('app', 'Reset code of your account on {hostInfo}: Verify code: {code}', [
                    'hostInfo' => Yii::$app->request->hostInfo,
                    'code' => $user->phone_verification,
                ]);
                Yii::$app->sms->sendMessage($user->username, $message);

                return [
                    'status' => true,
                    'code' => 124,
                    'message' => Yii::t('app', 'Message successfully sent!')
                ];

            } else {
                return [
                    'status' => false,
                    'code' => 125,
                    'message' => Yii::t('app', 'Verification code already sent!')
                ];
            }
        }

    }


    public function actionVerifyResetCode()
    {
        Yii::$app->language = Yii::$app->request->get('lang');

        $phone = Yii::$app->request->post('phone');
        $code = Yii::$app->request->post('code');

        $user = User::findOne(['username' => $phone]);

        if (!$user) {
            Yii::$app->response->statusCode = 404;
            return [
                'status' => false,
                'code' => 123,
                'message' => Yii::t('app', 'User not found')
            ];
        } else {

            if ($user->validateCode($code)) {
                return [
                    'status' => true,
                    'code' => 42,
                    'message' => Yii::t('app', 'Code successfully verified!'),
                    'auth_key' => $user->auth_key
                ];
            } else {
                return [
                    'status' => false,
                    'code' => 43,
                    'message' => Yii::t('app', 'Code error!')
                ];
            }
        }

    }


    public function actionResetPassword()
    {
        Yii::$app->language = Yii::$app->request->get('lang');

        $auth_key = Yii::$app->request->post('auth_key');
        $password = Yii::$app->request->post('password');
        $user = User::findOne(['auth_key' => $auth_key]);

        if (!$user) {
            Yii::$app->response->statusCode = 404;
            return [
                'status' => false,
                'code' => 123,
                'message' => Yii::t('app', 'User not found')
            ];
        } else {

            $user->phone_verification = "";
            $user->setPassword($password);
            $user->save();

            return [
                'status' => true,
                'code' => 127,
                'user' => $user,
                'message' => Yii::t('app', 'Your password changed!')
            ];

        }

    }


    public function actionLogin()
    {

        Yii::$app->language = Yii::$app->request->get('lang');
        $username = Yii::$app->request->post('phone');
        $password = Yii::$app->request->post('password');

        $model = new LoginForm();
        $model->username = $username;
        $model->password = $password;

        if (!$model->validate()) {
            return [
                'status' => false,
                'code' => 100,
                'message' => Yii::t('app', 'Username or password incorrect!')
            ];
        } else {
            return [
                'status' => true,
                'code' => 97,
                'user' => User::findOne(['username' => $username]),
                'message' => Yii::t('app', 'successfully logged!')
            ];
        }

    }

    public function actionSignup()
    {
        Yii::$app->language = Yii::$app->request->get('lang');
        $password = Yii::$app->request->post('password');

        if (strlen($password) <= 5) {
            return [
                'status' => 'error',
                'code' => 1,
                'message' => Yii::t('app', 'Password length short!')
            ];
        }

        $phone = str_replace(str_split('+() -'), '', Yii::$app->request->post('phone'));

        $user = new User();
        $user->username = $phone;
        $user->setPassword(Yii::$app->request->post('password'));
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->phone_verification = mt_rand(100000, 999999);
        $user->full_name = Yii::$app->request->post('fio');
//        $user->phone = Yii::$app->request->post('phone');
        // $user->phone_verification = mt_rand(100000,999999);
        // $user->birth_date = $this->birth_date;
        // $user->passport = $this->passport;
        // $user->passport_date_of_issue = $this->passport_date_of_issue;
        // $user->passport_date_of_expiry = $this->passport_date_of_expiry;
        // $user->passport_authority = $this->passport_authority;
        // $user->inn = $this->inn;
        // $user->town_id = $this->town_id;
        // $user->region_id = $this->region_id;
        // $user->address = $this->address;
        // $user->work = $this->work;
        // $user->kpp = $this->kpp;
        // $user->company_name = $this->company_name;
        // $user->ogrn = $this->ogrn;
        // $user->bik = $this->bik;
        // $user->account_number = $this->account_number;

        try {
            $user->save();
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $message = Yii::t('app', 'Activation code of your account on {hostInfo}: Verify code: {code}', [
                'hostInfo' => Yii::$app->request->hostInfo,
                'code' => $user->phone_verification,
            ]);
            Yii::$app->sms->sendMessage($user->username, $message);

            return [
                'status' => true,
                'message' => Yii::t('app', 'Success! Sms sended'),
                'authToken' => $user->auth_key,
                'fio' => $user->full_name,
                'phone' => $user->username,

            ];
        } catch (yii\db\Exception $e) {

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            Yii::$app->response->statusCode = 400;
            return [
                'status' => 'error',
                'code' => $e->errorInfo[1],
                'message' => $e->errorInfo[2]
            ];
        }
    }

    public function actionVerifyPhone()
    {

        Yii::$app->language = Yii::$app->request->get('lang');

        $auth_key = Yii::$app->request->post('auth_key');
        $code = Yii::$app->request->post('code');


        $user = User::findOne(['auth_key' => $auth_key, 'status' => 5]);

        $date1 = $user->updated_at;
        $date2 = date('U');


        if (!$user) {
//            Yii::$app->response->statusCode = 404;
            return [
                'status' => 'error',
                'code' => 2,
                'message' => $code . " " . $auth_key . " " . Yii::t('app', "User sasanot found!")
            ];
        } else {

            if ($date2 - $date1 > Yii::$app->params['verify_phone_expire']) {
                Yii::$app->response->statusCode = 404;
                return [
                    'status' => 'error',
                    'code' => 3,
                    'message' => Yii::t('app', "Verification Code expired!")
                ];
            }

            if ($user->phone_verification == $code) {

                $user->status = 10;
                $user->phone_verification = null;
                $user->save();

                Yii::$app->response->statusCode = 200;
                return [
                    'status' => 'succes',
                    'code' => 4,
                    'message' => Yii::t('app', "User successfully verified!")
                ];
            } else {
                Yii::$app->response->statusCode = 401;
                return [
                    'status' => 'error',
                    'code' => 5,
                    'message' => Yii::t('app', "Invalid verification code!")
                ];
            }
        }
    }

    public function actionResetVerificationCode()
    {
        Yii::$app->language = Yii::$app->request->get('lang');

        $auth_key = Yii::$app->request->post('auth_key');
        $user = User::findOne(['auth_key' => $auth_key, 'status' => 5]);
        $date1 = $user->updated_at;
        $date2 = date('U');

        if (!$user) {
            Yii::$app->response->statusCode = 404;
            return [
                'status' => 'error',
                'code' => 2,
                'message' => Yii::t('app', "User not found!")
            ];
        } else {
            if ($date2 - $date1 > Yii::$app->params['verify_phone_expire']) {

                $user->phone_verification = mt_rand(100000, 999999);
                $user->save();

                return [
                    'status' => 'success',
                    'code' => 6,
                    'message' => Yii::t('app', "Verification code sended!")
                ];
            } else {
                Yii::$app->response->statusCode = 401;
                return [
                    'status' => 'error',
                    'code' => 7,
                    'message' => Yii::t('app', "Verification code alreay sent!")
                ];
            }
        }
    }
}
