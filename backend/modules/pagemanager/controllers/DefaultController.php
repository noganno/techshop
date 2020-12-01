<?php

namespace backend\modules\pagemanager\controllers;

use yii\web\Controller;

/**
 * Default controller for the `pagemanager` module
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
}
