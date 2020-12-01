<?php


namespace frontend\controllers;


use yii\web\Controller;

class LoanController extends Controller
{
    public function actionRequest()
    {
//           dd(\Yii::$app->request->post());
    return $this->render('request');
    }

}