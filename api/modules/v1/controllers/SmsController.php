<?php

namespace api\modules\v1\controllers;

use common\models\Product;
use common\models\ProductToSklad;
use common\models\Sklad;
use common\models\User;
use yii;
use yii\base\Controller;


set_time_limit(3600);

class SmsController extends Controller
{

    public function actionSmsSend()
    {
        $body = Yii::$app->request->getRawBody();
        $body = json_decode($body);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return Yii::$app->sms->sendMessage($body->phone, $body->message);

    }

}
