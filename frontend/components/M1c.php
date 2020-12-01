<?php

namespace frontend\components;

use yii;
use yii\httpclient\Client;

class M1c extends \yii\base\Model

{

    public $username = "newsite";
    public $password = "newsite";

    public function checkPhone($phone)
    {

//        $phone = str_replace("+", "", $phone);
//
//        $client = new Client();
//        $request = $client->createRequest()
//            ->setMethod('GET')
////            ->setUrl('http://www.kun.uz')
//            ->setUrl('http://213.230.110.133:8181/Copy_ut_pustoy/hs/newapi/authPhone/')
//            ->setData(['phnumber' => $phone]);
//
//        $request->headers->set('Authorization', 'Basic ' . base64_encode("$this->username:$this->password"));
//
//        $response = $request->send();
//
//        if ($response->data['GUID'] != "no customer") {
//            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_WARNING, [
//                [
//                    'title' => t('You have been registered'),
//                    'text' => t('registered_message'),
//                    'footer' => yii\helpers\Html::a(t('Recovery'), ['user/register']),
//                    'confirmButtonText' => 'OK',
//                ]
//            ]);
//            return false;
//        } else {
//            return true;
//        }

        return true;

    }


    public function checkInn($inn)
    {

//        $client = new Client();
//        $request = $client->createRequest()
//            ->setMethod('GET')
////            ->setUrl('http://www.kun.uz')
//            ->setUrl('http://213.230.110.133:8181/Copy_ut_pustoy/hs/newapi/checkinn/')
//            ->setData(['inn' => $inn]);
//
//        $request->headers->set('Authorization', 'Basic ' . base64_encode("$this->username:$this->password"));
//
//        $response = $request->send();
//
//
//        if ($response->data['goods']) {
//            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_WARNING, [
//                [
//                    'title' => t('You have been registered'),
//                    'text' => t('inn_registered_message'),
//                    'footer' => yii\helpers\Html::a(t('Recovery'), ['user/register']),
//                    'confirmButtonText' => 'OK',
//                ]
//            ]);
//            return false;
//        } else {
//            return true;
//        }

        return true;
    }
}