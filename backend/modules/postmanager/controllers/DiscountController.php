<?phpnamespace backend\modules\postmanager\controllers;use Yii;use soft\web\SController;use backend\modules\postmanager\models\Discount;use backend\modules\postmanager\models\search\DiscountSearch;/** * DiscountController implements the CRUD actions for Discount model. */class DiscountController extends SController{    public function actions()    {        return [            'uploadimage' => [                'class' => 'odilov\cropper\UploadAction',                'url' => "/uploads/discount",                'path' => '@frontend/web/uploads/discount',                'jpegQuality' => 75,            ]        ];    }    public function actionIndex()    {        $searchModel = new DiscountSearch();        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        return $this->render('index', [            'searchModel' => $searchModel,            'dataProvider' => $dataProvider,        ]);    }    public function actionView($id)    {        return $this->render('view', [            'model' => Discount::findModel($id),        ]);    }    public function actionCreate()    {        $model = new Discount();        $model->prepareAttributesForForm();        if ($model->load(Yii::$app->request->post()) ) {            $model->prepareAttributesToSave();            if($model->save()){                return $this->redirect(['view', 'id' => $model->id]);            }        }        return $this->render('create', [            'model' => $model,        ]);    }    public function actionUpdate($id)    {        $model = Discount::findModel($id);        $model->prepareAttributesForForm();        if ($model->load(Yii::$app->request->post()) ) {            $model->prepareAttributesToSave();            if($model->save()){                return $this->redirect(['view', 'id' => $model->id]);            }        }        return $this->render('update', [            'model' => $model,        ]);    }    public function actionDelete($id)    {        Discount::findModel($id)->delete();        return $this->redirect(['index']);    }    public function actionUpdateImages($id)    {        $model = Discount::findModel($id);        $path = Yii::getAlias('@frontend/web');        $oldIndexImage = $path.$model->image_index;        $oldGridImage = $path.$model->image_grid;        $oldDetailImage = $path.$model->image_detail;        if ($model->load(Yii::$app->request->post()) ) {            if($model->save()){                if (is_file($oldIndexImage)){                    unlink($oldIndexImage);                }                  if (is_file($oldGridImage)){                    unlink($oldGridImage);                }                  if (is_file($oldDetailImage)){                    unlink($oldDetailImage);                }                return $this->redirect(['view', 'id' => $model->id]);            }        }        return $this->render('updateImages', [            'model' => $model,        ]);    }}