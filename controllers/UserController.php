<?php


namespace backend\controllers;


use backend\models\User;
use yii\web\Controller;

class UserController extends Controller
{

    public function actions()
    {
        return [
            'uploadimage' => [
                'class' => 'odilov\cropper\UploadAction',
                'url' => "/files/profileImages",
                'path' => '@frontend/web/files/profileImages',
                'jpegQuality' => 75,
            ]
        ];
    }


    public function actionProfile()
    {

        $model = User::findOne(['id' => \Yii::$app->user->identity->id]);
        $model->scenario = 'updatePersonalData';

        if ($model->load(\Yii::$app->request->post())) {

            $model->save();
            $this->redirect(['site/index']);
        }
        return $this->render('profile', [
            'model' => $model
        ]);
    }


}