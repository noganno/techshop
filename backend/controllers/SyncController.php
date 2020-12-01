<?php


namespace backend\controllers;

use yii\web\Controller;

set_time_limit(3600);

class SyncController extends Controller
{


    public function actionIndex()
    {

        return $this->render('index');
    }


    public function actionGetJson()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://213.230.110.133:8181/Copy_RoznicaUT/hs/newapi/getgoods",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic bmV3c2l0ZTpuZXdzaXRl"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

//        dd($response);

    }
}


?>