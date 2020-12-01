<?php


namespace api\modules\v1\controllers;

use yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;

class LegalOrderController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\LegalOrder';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function init()
    {
        parent::init();
        Yii::$app->language = Yii::$app->request->get('lang');
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'add' => ['post'],
            ],
        ];
        return $behaviors;
    }

    public function actionAdd()
    {

    }
}