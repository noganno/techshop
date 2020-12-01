<?php

namespace backend\controllers;

use soft\web\SController;
use Yii;
use backend\models\Warranty;
use backend\models\search\WarrantySearch;

class WarrantyController extends SController

{

    public function actionIndex()

    {
        $searchModel = new WarrantySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' =>  Warranty::findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Warranty();
        if ($model->loadSave()) {
            return $this->redirect(['index']);

        }
        return $this->render('create', compact('model'));
    }

    public function actionUpdate($id)
    {
        $model = Warranty::findModel($id);
        if ($model->loadSave()) {
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
}

