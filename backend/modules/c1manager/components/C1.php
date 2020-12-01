<?php

namespace backend\modules\c1manager\components;

use backend\modules\c1manager\models\C1manager;
use yii;
use yii\base\Component;
use yii\helpers\Json;
use yii\httpclient\Client;

class C1 extends Component
{
    public $auth_keys;
    public $signup;
    public $userinfo_via_guid;
    public $authPhone;
    public $authInn;
    public $getSklads;
    public $getSkladProducts;
    public $getSkladRegions;
    public $createOrder;

    public function init()
    {
        $this->auth_keys = C1manager::findOne(['name' => 'auth_keys']);
        $this->signup = C1manager::findOne(['name' => 'sign_up']);
        $this->authPhone = C1manager::findOne(['name' => 'get_info_via_phone']);
        $this->authInn = C1manager::findOne(['name' => 'get_info_via_inn']);
        $this->userinfo_via_guid = C1manager::findOne(['name' => 'get_info_via_guid']);
        $this->getSklads = C1manager::findOne(['name' => 'get_stores']);
        $this->getSkladProducts = C1manager::findOne(['name' => 'get_stores_goods']);
        $this->getSkladRegions = C1manager::findOne(['name' => 'get_regions']);
        $this->createOrder = C1manager::findOne(['name' => 'create_new_order']);
        parent::init();
    }

    // get auth keys

    public function getAuthKeys()
    {
        return $this->auth_keys;
    }

    // =====================================================================


    // Sign Up

    public function signup($params = [])
    {
        $url = $this->signup->url;
        $params = Json::encode($params);
        $username = $this->auth_keys->username;
        $password = $this->auth_keys->password;

        $client = new Client();
        $request = $client->createRequest()
            ->addHeaders(['content-type' => 'application/json'])
            ->setMethod('POST')
            ->setUrl($url)
            ->setContent($params);

        $request->headers->set('Authorization', 'Basic ' . base64_encode("$username:$password"));
        $response = $request->send();

        if ($response->statusCode != 200) {
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_WARNING, [
                [
                    'title' => $response->statusCode,
                    'text' => $response->content,
                    'confirmButtonText' => 'OK',
                ]
            ]);
            return false;
        }

        return $response;
    }

    // =====================================================================

    //get goods

    public function getGoods()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('http://www.kun.uz')
//            ->setData(['name' => 'John Doe', 'email' => 'johndoe@example.com'])
            ->send();
//        if ($response->isOk) {
//            $newUserId = $response->data['id'];
//        }

        return $response;
    }

    // ======================================================================


    // get user info

    public function getUserInfo($guid)
    {
        $url = $this->userinfo_via_guid->url;
        $username = $this->auth_keys->username;
        $password = $this->auth_keys->password;

        $client = new Client();
        $request = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($url)
            ->setData(['guid' => $guid]);

        $request->headers->set('Authorization', 'Basic ' . base64_encode("$username:$password"));

        $response = $request->send();

        if ($response->statusCode != 200) {
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_WARNING, [
                [
                    'title' => $response->statusCode,
                    'text' => $response->content,
                    'confirmButtonText' => 'OK',
                ]
            ]);
            return false;
        }


        return $response;
    }


    public function getSklads()
    {
        $url = $this->getSklads->url;
        $username = $this->auth_keys->username;
        $password = $this->auth_keys->password;

        $client = new Client();
        $request = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($url);

        $request->headers->set('Authorization', 'Basic ' . base64_encode("$username:$password"));

        $response = $request->send();

        if ($response->statusCode != 200) {
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_WARNING, [
                [
                    'title' => $response->statusCode,
                    'text' => $response->content,
                    'confirmButtonText' => 'OK',
                ]
            ]);
            return false;
        }

        return $response->content;
    }

    public function getSkladRegions()
    {
        $url = $this->getSkladRegions->url;
        $username = $this->auth_keys->username;
        $password = $this->auth_keys->password;

        $client = new Client();
        $request = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($url);

        $request->headers->set('Authorization', 'Basic ' . base64_encode("$username:$password"));

        $response = $request->send();

        if ($response->statusCode != 200) {
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_WARNING, [
                [
                    'title' => $response->statusCode,
                    'text' => $response->content,
                    'confirmButtonText' => 'OK',
                ]
            ]);
            return false;
        }

        return $response->content;
    }

    public function getSkladProductsCount($store)
    {
        $url = $this->getSklads->url;
        $username = $this->auth_keys->username;
        $password = $this->auth_keys->password;

        $client = new Client();
        $request = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($url)
            ->setData(['store' => $store]);

        $request->headers->set('Authorization', 'Basic ' . base64_encode("$username:$password"));

        $response = $request->send();

        if ($response->statusCode != 200) {
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_WARNING, [
                [
                    'title' => $response->statusCode,
                    'text' => $response->content,
                    'confirmButtonText' => 'OK',
                ]
            ]);
            return false;
        }


        foreach ($response->data as $sklad) {
            if ($store == $sklad['УникальныйИдентификатор']) {
                return $sklad['ОбшееКоличество'];
            }
        }

    }

    public function getSkladProducts($sklad_id)
    {
        $url = $this->getSkladProducts->url;
        $username = $this->auth_keys->username;
        $password = $this->auth_keys->password;

        $client = new Client();
        $request = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($url)
            ->setData(['store' => $sklad_id]);

        $request->headers->set('Authorization', 'Basic ' . base64_encode("$username:$password"));

        $response = $request->send();

        if ($response->statusCode != 200) {
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_WARNING, [
                [
                    'title' => $response->statusCode,
                    'text' => $response->content,
                    'confirmButtonText' => 'OK',
                ]
            ]);
            return false;
        }

        $r = json_decode($response->content);

        $ostatki = $r->Остатки;
        return $ostatki;
    }

    // ======================================================================


    public function checkPhone($phone)
    {
        $url = $this->authPhone->url;

        $phone = str_replace("+", "", $phone);

        $client = new Client();
        $request = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($url)
            ->setData(['phnumber' => $phone]);

        $request->headers->set('Authorization', 'Basic ' . base64_encode("{$this->auth_keys->username}:{$this->auth_keys->password}"));

        $response = $request->send();

        if ($response->statusCode != 200) {
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_WARNING, [
                [
                    'title' => $response->statusCode,
                    'text' => $response->content,
                    'confirmButtonText' => 'OK',
                ]
            ]);
            return false;
        }
        if ($response->data['GUID'] != "no customer") {
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_WARNING, [
                [
                    'title' => t('You have been registered'),
                    'text' => t('registered_message'),
                    'footer' => yii\helpers\Html::a(t('Recovery'), ['user/register']),
                    'confirmButtonText' => 'OK',
                ]
            ]);
            return false;
        } else {
            return true;
        }


    }


    public function checkInn($inn)
    {
        $url = $this->authInn->url;


        $client = new Client();
        $request = $client->createRequest()
            ->setMethod('GET')
//            ->setUrl('http://www.kun.uz')
            ->setUrl($url)
            ->setData(['inn' => $inn]);

        $request->headers->set('Authorization', 'Basic ' . base64_encode("{$this->auth_keys->username}:{$this->auth_keys->password}"));

        $response = $request->send();

        if ($response->statusCode != 200) {
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_WARNING, [
                [
                    'title' => $response->statusCode,
                    'text' => $response->content,
                    'confirmButtonText' => 'OK',
                ]
            ]);
            return false;
        }

//        dd($response->data['info']);

        if ($response->data['info']) {
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_WARNING, [
                [
                    'title' => t('You have been registered'),
                    'text' => t('inn_registered_message'),
                    'footer' => yii\helpers\Html::a(t('Recovery'), ['user/register']),
                    'confirmButtonText' => 'OK',
                ]
            ]);
            return false;
        } else {
            return true;
        }

    }

    public function createNewOrder()
    {
        $url = $this->createOrder->url;
        $username = $this->auth_keys->username;
        $password = $this->auth_keys->password;

        $client = new Client();
        $request = $client->createRequest()
            ->setMethod('POST')
            ->setUrl($url);
//            ->setData(['guid' => $guid]);

        $request->headers->set('Authorization', 'Basic ' . base64_encode("$username:$password"));

        $response = $request->send();

        if ($response->statusCode != 200) {
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_WARNING, [
                [
                    'title' => $response->statusCode,
                    'text' => $response->content,
                    'confirmButtonText' => 'OK',
                ]
            ]);
            return $response;
        }
        
        return $response;
    }


}