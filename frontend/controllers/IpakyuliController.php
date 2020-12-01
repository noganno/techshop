<?php

namespace frontend\controllers;


use yii;
use yii\web\Controller;

class IpakyuliController extends Controller
{


    public $enableCsrfValidation = false;
    public $url = "https://wi.ipakyulibank.uz/acquiring/hJaAGAA/Uz5QszX1kA9J6C6A7UtYScICvmVZ/";
    public $key = "k4W76WCpfz5W1z3NpBKa7dp7d0pJfwa1";


    public function actionSuccess()
    {

        $r = Yii::$app->request->getRawBody();

        $json = $r;
        \Yii::info($r);

        $r = json_decode($r);

        $transactionID = $r->transactionID;

        Yii::$app->ipakyuli->setTransactionSuccessCode($transactionID, $json);

        Yii::$app->response->format = "json";


        return [
            'code' => 0
        ];
    }

    public function actionFail()
    {
        $r = Yii::$app->request->getRawBody();


        $json = $r;
        \Yii::info($r);

        $r = json_decode($r);

        $transactionID = $r->transactionID;
        $error_code = $r->code;

        Yii::$app->ipakyuli->setTransactionErrorCode($transactionID, $error_code, $json);

        Yii::$app->response->format = "json";

        return [
            'code' => 0
        ];
    }

    public function actionRedirect()
    {
        $r = Yii::$app->request->getRawBody();

        \Yii::info($r);

        return 1;
    }


    public function actionTest()
    {

        $resp = Yii::$app->ipakyuli->createNewTransaction(1233333, Yii::$app->user->identity->id, 5000);

        return $resp;

    }

    public function actionIpakyuliAdmin()
    {
        $resp = Yii::$app->ipakyuli->createNewTransaction(1233333, Yii::$app->user->identity->id, 500000, true);

//        dd($resp);
        return $resp;
    }



}
