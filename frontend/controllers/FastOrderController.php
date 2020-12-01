<?php


namespace frontend\controllers;

use frontend\models\FastOrder;
use frontend\models\Product;
use soft\helpers\SArray;
use soft\web\SController;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;


class FastOrderController extends SController
{

    public function init()
    {
        parent::init();
        if ($this->isAjax) {
            $this->getFormatJson();
        }
    }

    public function actionShow()
    {
        $id = $this->request->get('id');
        $product = Product::findActiveProductOrFail($id);
        $fastOrderModel = new FastOrder([

            'tel' => '+998',
        ]);
        $fastOrderModel->loadDefaultValues($product->id);

        return $this->success([
            'content' => $this->renderAjax('productView', [
                'product' => $product,
                'fastOrderModel' => $fastOrderModel,
                'telReadOnly' => false,
            ]),
        ]);
    }

    public function actionSend()
    {
        $fastOrderModel = new FastOrder();
        $fastOrderModel->load(Yii::$app->request->post());
        $product = Product::findActiveProductOrFail($fastOrderModel->product_id);

//        if user authenticated
        if ($this->hasUser) {
            $fastOrderModel->name = Yii::$app->user->identity->name;
            $fastOrderModel->tel = Yii::$app->user->identity->phone;
            return $this->acceptOrder($fastOrderModel);
        }

        if ($fastOrderModel->validate()) {

//          if user is temp user
            if ($fastOrderModel->isTempUser) {
                return $this->acceptOrder($fastOrderModel);
            }


            if ($fastOrderModel->sendCodeViaSms()) {

                $fastOrderModel->scenario = 'verifyPhoneNumber';
                return $this->success([
                    'content' => $this->renderAjax('verifyPhoneNumber', [
                        'product' => $product,
                        'fastOrderModel' => $fastOrderModel,
                        'telReadOnly' => true,

                    ]),
                ]);
            }
            $fastOrderModel->addError('tel', t("An error occured while sending verification code to your phone number"));
        }


        return $this->success([
            'content' => $this->renderAjax('productView', [
                'product' => $product,
                'fastOrderModel' => $fastOrderModel,
            ]),
        ]);

    }


    public function actionVerify()
    {
        $fastOrderModel = new FastOrder();
        $fastOrderModel->scenario = 'verifyPhoneNumber';
        $fastOrderModel->load(Yii::$app->request->post());
        $product = Product::findActiveProductOrFail($fastOrderModel->product_id);

        if ($fastOrderModel->validate()) {

            if ($fastOrderModel->checkCode()) {
                $fastOrderModel->saveTempUser();
                return $this->acceptOrder($fastOrderModel);

            }
            $fastOrderModel->addError('code', t("Invalid verification code"));
        }

        return $this->success([
            'content' => $this->renderAjax('verifyPhoneNumber', [
                'product' => $product,
                'fastOrderModel' => $fastOrderModel,
            ]),
        ]);

    }


    private function footer($totalPrice = '')
    {

        $html = <<<HTML
        <button type="submit" class="btn btn-yellow-3">{checkoutLabel}</button>
        <button type="button" class="btn btn-white-2" data-dismiss="modal">{closeLabel}</button>
HTML;

        return strtr($html, [
            "{checkoutLabel}" => t('Checkout'),
            "{closeLabel}" => t('Close'),
        ]);

    }


    private function success($options)
    {
        $title = SArray::getValue($options, 'title', t('Fast order'));
        $content = SArray::getValue($options, 'content');
        $footer = SArray::getValue($options, 'footer', $this->footer());

        if ($this->isAjax) {
            return [
                'title' => $title,
                'content' => $content,
                'footer' => $footer,
            ];
        } else return $this->back();

    }

    /**
     * @param $model FastOrder
     */
    private function acceptOrder($model)
    {

        $footer = '<button type="button" class="btn btn-white-2" data-dismiss="modal">' . t('Close') . '</button>';
        if ($model->acceptOrder()) {

            $product = Product::findOne($model->product_id);
            Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'fastOrder-html', 'text' => 'fastOrder-text'],
                    [
                        'name' => $model->name,
                        'tel' => Yii::$app->help->clearPhoneNumber($model->tel),
                        'count' => $model->count,
                        'product' => $product
                    ]
                )
                ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->help->clearPhoneNumber($model->tel) . "@texnomart.uz"])
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject('Быстрий заказ: new texnomart.uz')
                ->send();

            Yii::$app->cart->clear();


            return $this->success([
                'content' => tag('h4', t('Your order has been accepted. We will contact you as soon as possible!'), [
                    'class' => 'text-success',
                ]),
                'footer' => $footer,
            ]);
        } else {
            return $this->success([
                'content' => tag('h4', t('An error occured while sending your order'), [
                    'class' => 'text-error',
                ]),
                'footer' => $footer,
            ]);
        }

    }

    public function actionResend()
    {

        sleep(1);
        $fastOrderModel = new FastOrder();
        $fastOrderModel->tel = $this->request->get('tel');

        if ($this->isAjax) {
            if ($fastOrderModel->sendCodeViaSms()) {
                return Json::encode([
                    'success' => true,
                    'message' => t('New code sent to your phone number'),
                ]);
            } else {
                return Json::encode([
                    'success' => false,
                    'message' => t('An error occured while sending your order'),
                ]);
            }
        }
        return $this->back();
    }

    public function actionMail()
    {

        Yii::$app
            ->mailer
            ->compose(
                ['html' => 'fastOrder-html', 'text' => 'fastOrder-text'],
                ['test' => 'test']
            )
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name . ' robot'])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }


}