<?php


namespace backend\controllers;
use Yii;
use yii\filters\VerbFilter;

class MainController extends \soft\web\SController
{

  /*  public function init()
    {
        parent::init();
        $language = Yii::$app->request->get('language', 'uz');
        Yii::$app->help->setLanguage($language);
    }*/

    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'bulk-delete' => ['POST'],
                ],
            ],
        ];
    }*/

}