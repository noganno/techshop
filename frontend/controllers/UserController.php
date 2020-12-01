<?php


namespace frontend\controllers;


use common\models\User;
use frontend\models\Inn;
use frontend\models\LegalSignupForm;
use frontend\models\Phone;
use frontend\models\ResetPasswordPhoneForm;
use frontend\models\SignupForm;
use frontend\models\VerifyEmailForm;
use yii;
use yii\filters\AccessControl;

class UserController extends \soft\web\SController
{


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['reset-password', 'set-new-password', 'register'],
                'rules' => [
                    [
                        'actions' => ['reset-password', 'set-new-password', 'register'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],

        ];
    }

    //<editor-fold desc="Functions" defaultstate="collapsed">

    public function actionResendVerifyCode()
    {
        $phone = new Phone();
        if (Yii::$app->session->get('verifyPhoneNumber')) {
            $phone->username = Yii::$app->session->get('verifyPhoneNumber');
            $phone->sendVerifyCode();
            return $this->redirect(['user/register']);
        }
        return $this->redirect(['user/register']);
    }

    public function actionResendInnVerifyCode()
    {
        $inn = new Inn();
        if (Yii::$app->session->get('verifyInnPhoneNumber')) {
            $inn->phone = Yii::$app->session->get('verifyInnPhoneNumber');
            if (!$inn->sendVerifyCode()) {
                Yii::$app->session->setFlash('innPhoneVerifyCodeSent', t('Code already sent!'));
            }
            return $this->redirect(['user/register']);
        }
        return $this->redirect(['user/register']);
    }

    public function actionChangePhoneNumber()
    {
        $phone = new Phone();
        $phone->clearData();
        return $this->redirect(['user/register']);
    }

    public function actionRegister($type = null)
    {


        throw new \yii\web\HttpException(403, 'Идет доработка...');

        if ($type == 'legal') {
            $this->setPageActive('yuridik');
        } else {
            $this->setPageActive('jismoniy');
        }
        $legal = new LegalSignupForm();
        $phone = new Phone();
        $person = new SignupForm();


        $person->phone = Yii::$app->session->get('verifyPhoneNumber');

        if ($legal->load(Yii::$app->request->post())) {
            $this->setPageActive('yuridik');

            if ($legal->signup()) {
                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                    [
                        'title' => t('You are registered'),
                        'text' => Yii::t('app', 'legal_success_message {email}', [
                            'email' => $legal->email
                        ]),
                        'confirmButtonText' => 'OK',
                    ]
                ]);
                return $this->goHome();
            } else {
                return $this->render('register', [
                    'phone' => $phone,
                    'person' => $person,
                    'legal' => $legal,

                ]);
            }

        }
        if ($phone->load(Yii::$app->request->post())) {

            $this->setPageActive('jismoniy');

            if ($phone->validate()) {
                if (!Yii::$app->session->get('smsSended')) {
                    if ($phone->sendVerifyCode()) {
                        Yii::$app->session->set('smsSended', true);
                        return $this->render('register', [
                            'phone' => $phone,
                            'person' => $person,
                            'legal' => $legal,

                        ]);
                    } else {
                        return $this->render('register', [
                            'phone' => $phone,
                            'person' => $person,
                            'legal' => $legal,

                        ]);
                    }
                } else {
//                    dd($phone);
                    if ($phone->validateCode()) {
                        Yii::$app->session->set('tempUserVerified', true);
                        return $this->render('register', [
                            'model' => $person,
                            'person' => $person,
                            'legal' => $legal,
                        ]);
                    } else {
                        return $this->render('register', [
                            'phone' => $phone,
                            'person' => $person,
                            'legal' => $legal,

                        ]);
                    }
                }
            }

            $phone->username = $oldPhone;
            return $this->render('register', [
                'phone' => $phone,
                'person' => $person,
                'legal' => $legal,
            ]);
//            dd($phone->errors);
        }
        if ($person->load(Yii::$app->request->post())) {
            $this->setPageActive('jismoniy');
            if ($person->validate()) {

                $person->phone = Yii::$app->session->get('verifyPhoneNumber');
                if ($person->signup()) {

                    $user1 = User::findOne(['username' => $person->username]);
                    Yii::$app->user->login($user1, 3600 * 24 * 30);
                    $phone->clearData();
                    return $this->goHome();

                }
            }
        }


        return $this->render('register', [
            'phone' => $phone,
            'person' => $person,
            'legal' => $legal,

        ]);


    }

    public function setPageActive($page)
    {
        Yii::$app->session->set('activeTab', $page);
    }

    // </editor-fold>

    public function actionResetPassword()
    {

        $model = new ResetPasswordPhoneForm([
            'scenario' => 'requestResetPassword',
            'phone' => "+998",
        ]);

        if ($this->modelValidate($model) && $model->checkUser()) {

            return $this->redirect(['user/set-new-password']);

        }

        return $this->render('requestResetPassword', [
            'model' => $model
        ]);
    }

    public function actionSetNewPassword()
    {
        $resetUserId = $this->session->get('_resetUserId');
        $code = $this->session->get('_resetUserCode');
        if ($resetUserId == null || $code == null) {
            not_found();
        }

        $user = User::findOne($resetUserId);
        if ($user == null) {
            not_found();
        }

        $model = new ResetPasswordPhoneForm([
            'scenario' => 'setNewPassword',
        ]);

        if ($this->modelValidate($model)) {

            if ($code == $model->code) {


                $user->password_hash = Yii::$app->security->generatePasswordHash($model->password);

                if ($user->save()) {

                    $this->setFlash('success', t('Your password has been changed successfully'));
                    return $this->redirect(['site/login']);
                }

            } else {
                $model->addError('code', t('Invalid verification code'));
            }

        }

        return $this->render('setNewPassword', [
            'model' => $model
        ]);

    }

    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);

        } catch (\InvalidArgumentException $e) {
            throw new yii\web\BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', t('Your email has been confirmed!'));
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }


}