<?php

namespace backend\controllers;

use soft\web\SController;
use Yii;
use backend\models\Country;
use backend\models\search\CountrySearch;

class CountryController extends SController

{

    public function actionIndex()

    {
        $searchModel = new CountrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' =>  Country::findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Country();
        if ($model->loadSave()) {
            return $this->redirect(['index']);

        }
        return $this->render('create', compact('model'));
    }

    public function actionUpdate($id)
    {
        $model = Country::findModel($id);
        if ($model->loadSave()) {
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
}

