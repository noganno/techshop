<?php

namespace backend\modules\usermanager\controllers;

use backend\modules\usermanager\models\search\UserSearch;
use backend\modules\usermanager\models\User;
use soft\web\SController;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class DefaultController extends SController
{

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => User::findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new User([
            'scenario' => 'create',
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = User::findModel($id);
        $model->scenario = 'update';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->setNewPassword();
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionChangeStatus($id = '')
    {
        $model = User::findModel($id);
        $model->status = $model->status == 10 ? 9 : 10;
        $model->scenario = 'change-status';
        $model->save();
        return $this->back();
    }


}
