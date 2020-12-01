<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends Controller
{

    public function init()
    {
        $lang = Yii::$app->request->post('lang');
        Yii::$app->language = $lang;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        parent::init();
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
