<?php


namespace backend\modules\c1manager\controllers;

use backend\modules\c1manager\models\C1manager;
use yii;
use yii\web\Controller;

class ControlController extends Controller
{
    public function actionIndex()
    {
        $c1Rows = C1manager::find()->all();
        return $this->render('index', [
            'apis' => $c1Rows
        ]);
    }


    public function actionUpdate($id)
    {
        $model = C1manager::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
                $this->redirect(['control/index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionTest()
    {
        return Yii::$app->c1->createNewOrder();
    }
}