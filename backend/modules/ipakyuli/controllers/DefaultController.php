<?php

namespace backend\modules\ipakyuli\controllers;

use yii\web\Controller;
use yii;
/**
 * Default controller for the `ipakyuli` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionIpakyuliAdmin()
    {
        $resp = Yii::$app->ipakyuli->createNewTransaction(1233333, Yii::$app->user->identity->id, 500000, true);

//        dd($resp);
        return $resp;
    }
}
