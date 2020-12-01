<?php


namespace frontend\controllers;

use common\models\LegalOrders;
use common\models\Order;
use frontend\models\verifications\Phone;
use soft\web\SController;
use Yii;
use yii\filters\AccessControl;

class ShopController extends SController
{

    public function behaviors()
    {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['checkout', 'rassrochka'],
//                'rules' => [
//                    [
//                        'actions' => ['checkout', 'rassrochka'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//
//                ],
//            ],

        ];
    }

    public function actionCheckout()
    {


        if (!Yii::$app->cart->getItems()) {
            $this->redirect(['site/index']);
        }

        $products = Yii::$app->cart->getProducts();
        $model = new Order();
        $verify = new Phone();
//        $model->user_id = Yii::$app->user->identity->id;
        $model->user_id = 1;
//        $model->fio = Yii::$app->user->identity->name . " " . Yii::$app->user->identity->surname;
//        $model->address = Yii::$app->user->identity->address;
//        $model->phone = Yii::$app->user->identity->phone;

        $model->payment_type = 1;

//        if ($verify->load(Yii::$app->request->post())) {
//            if (Yii::$app->session->has('orderModel')) {
//                if ($verify->validate()) {
//                    if ($verify->compareCode()) {
//                        $model_temp = Yii::$app->session->get('orderModel');
//                        $model = new Order();
//                        if (Yii::$app->user) {
//                            $model->user_id = Yii::$app->user->identity->id;
//                        }
//                        $model->fio = $model_temp['fio'];
//                        $model->address = $model_temp['address'];
//                        $model->phone = $model_temp['phone'];
//                        $model->comment = $model_temp['comment'];
//                        $model->payment_type = $model_temp['payment_type'];
//                        $model->amount = $model_temp['amount'];
//
//                        if ($model->save()) {
//                            Yii::$app->session->remove('orderModel');
//                            Yii::$app->session->remove('orderVerifyCode');
//                            Yii::$app->session->remove('orderVerifyCodeTime');
//                            Yii::$app->cart->clear();
//                            return $this->render('thanks', [
//                                'datetime' => $model->created_at,
//                                'id' => $model->id
//                            ]);
//                        } else {
//                            dd($model->errors);
//                        }
//                    } else {
//                        return $this->render('verifyPhone', [
//                            'model' => $verify
//                        ]);
//                    }
//
//                } else {
//                    return $this->render('verifyPhone', [
//                        'model' => $verify
//                    ]);
//                }
//            } else {
//                return $this->goHome();
//            }
//        }

        if ($model->load(Yii::$app->request->post())) {
            $model->amount = Yii::$app->cart->getFullPaymentAmount();

            if ($model->validate()) {
                $model->phone = Yii::$app->help->clearPhoneNumber($model->phone);
//                $verify->phone = Yii::$app->help->clearPhoneNumber($model->phone);

                if ($model->save()) {
                    Yii::$app->session->remove('orderModel');
                    Yii::$app->session->remove('orderVerifyCode');
                    Yii::$app->session->remove('orderVerifyCodeTime');

                    Yii::$app
                        ->mailer
                        ->compose(
                            ['html' => 'oplata-html', 'text' => 'oplata-text'],
                            [
                                'name' => $model->fio,
                                'tel' => $model->phone,
                                'products' => $products,
                            ]
                        )
                        ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->help->clearPhoneNumber($model->phone) . "@texnomart.uz"])
                        ->setTo(Yii::$app->params['adminEmail'])
                        ->setSubject('Полная оплата: new texnomart.uz')
                        ->send();

                    Yii::$app->cart->clear();

                    $form = Yii::$app->ipakyuli->createNewTransaction($model->id, Yii::$app->user->identity->id, $model->amount);

                    return $this->render('thanks', [
                        'datetime' => $model->created_at,
                        'id' => $model->id,
                        'paymentForm' => $form
                    ]);
                }

            }
        }
        return $this->render('checkout', [
            'model' => $model,
            'products' => $products
        ]);
    }

    public function actionLegalEntityOrder()
    {

        $model = new LegalOrders();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {

            return $this->redirect(['site/index']);

        }

        return $this->render("legal_order",
            [
                'model' => $model
            ]);
    }

    public function actionRassrochka()
    {

        if (!Yii::$app->cart->getItems()) {
            $this->redirect(['site/index']);
        }

        $products = Yii::$app->cart->getProducts();
        $model = new Order();
        $model->user_id = 1;
//        $model->user_id = Yii::$app->user->identity->id;
//        $model->fio = Yii::$app->user->identity->name . " " . Yii::$app->user->identity->surname;
//        $model->address = Yii::$app->user->identity->address;
//        $model->phone = Yii::$app->user->identity->phone;
        $type = Yii::$app->request->post('loan_type');

        $model->payment_type = $type;

        if ($model->load(Yii::$app->request->post())) {
            $model->amount = Yii::$app->cart->getFullPaymentAmount();

            if ($model->validate()) {
                $model->phone = Yii::$app->help->clearPhoneNumber($model->phone);
//                $verify->phone = Yii::$app->help->clearPhoneNumber($model->phone);

                if ($model->save()) {

                    Yii::$app
                        ->mailer
                        ->compose(
                            ['html' => 'rassrochka-html', 'text' => 'rassrochka-text'],
                            [
                                'name' => $model->fio,
                                'tel' => $model->phone,
                                'products' => $products,
                                'type' => $model->paymentType->name
                            ]
                        )
                        ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->help->clearPhoneNumber($model->phone) . "@texnomart.uz"])
                        ->setTo(Yii::$app->params['adminEmail'])
                        ->setSubject('Рассрочка: new texnomart.uz')
                        ->send();


                    Yii::$app->cart->clear();

//                    $form = Yii::$app->ipakyuli->createNewTransaction($model->id, Yii::$app->user->identity->id, $model->amount);

                    return $this->render('thanks', [
                        'datetime' => $model->created_at,
                        'id' => $model->id,
//                        'paymentForm' => $form
                    ]);
                }

            }
        }
        return $this->render('rassrochka', [
            'model' => $model,
            'products' => $products
        ]);
    }

}