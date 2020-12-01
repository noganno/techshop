<?phpnamespace backend\modules\postmanager\controllers;use backend\modules\postmanager\models\Discount;use backend\modules\postmanager\models\News;use common\models\Product;use Yii;use soft\web\SController;use backend\modules\postmanager\models\Review;use backend\modules\postmanager\models\search\ReviewSearch;use yii\db\Query;/** * ReviewController implements the CRUD actions for Review model. */class ReviewController extends SController{    public function actions()    {        return [            'uploadimage' => [                'class' => 'odilov\cropper\UploadAction',                'url' => "/uploads/review",                'path' => '@frontend/web/uploads/review',                'jpegQuality' => 75,            ]        ];    }    public function actionIndex()    {        $searchModel = new ReviewSearch();        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        return $this->render('index', [            'searchModel' => $searchModel,            'dataProvider' => $dataProvider,        ]);    }    public function actionView($id)    {        return $this->render('view', [            'model' => Review::findModel($id),        ]);    }    public function actionCreate()    {        $model = new Review();        $model->prepareAttributesForForm();        if ($model->load(Yii::$app->request->post()) ) {            $model->prepareAttributesToSave();            if($model->save()){                return $this->redirect(['view', 'id' => $model->id]);            }        }        return $this->render('create', [            'model' => $model,        ]);    }    public function actionUpdate($id)    {        $model = Review::findModel($id);        $model->prepareAttributesForForm();        if ($model->load(Yii::$app->request->post()) ) {            $model->prepareAttributesToSave();            if($model->save()){                return $this->redirect(['view', 'id' => $model->id]);            }        }        return $this->render('update', [            'model' => $model,        ]);    }    public function actionDelete($id)    {        Review::findModel($id)->delete();        return $this->redirect(['index']);    }    public function actionUpdateImages($id)    {        $model = Review::findModel($id);        $path = Yii::getAlias('@frontend/web');        $oldIndexImage = $path.$model->image_index;        $oldGridImage = $path.$model->image_grid;        $oldDetailImage = $path.$model->image_detail;        if ($model->load(Yii::$app->request->post()) ) {            if($model->save()){                if (is_file($oldIndexImage)){                    unlink($oldIndexImage);                }                  if (is_file($oldGridImage)){                    unlink($oldGridImage);                }                  if (is_file($oldDetailImage)){                    unlink($oldDetailImage);                }                return $this->redirect(['view', 'id' => $model->id]);            }        }        return $this->render('updateImages', [            'model' => $model,        ]);    }    public function actionProductList($q = null, $id = null) {        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;        $out = ['results' => ['id' => '', 'name' => '']];        if (!is_null($q)) {            $data = Product::find()                ->joinWith('translations')                ->where(['like', 'product_lang.name' , $q])                ->andWhere(['product_lang.language' => Yii::$app->language])                ->limit(20)                ->all();            if (!empty($data)){                $out['results'] = $data;            }        }        elseif ($id > 0) {            $out['results'] = ['id' => $id, 'name' => Product::findOne($id)->name];        }        return $out;    }    public function action()    {    }   /* public function actionSeed()    {        $allReview = News::find()->all();        foreach ($allReview as $news){            $n = new Discount([                'title_uz' => $news->title_uz,                'title_kr' => $news->title_kr,                'title_ru' => $news->title_ru,                'content_uz' => $news->content_uz,                'content_kr' => $news->content_kr,                'content_ru' => $news->content_ru,                'meta_title_uz' => $news->meta_title_uz,                'meta_title_kr' => $news->meta_title_kr,                'meta_title_ru' => $news->meta_title_ru,                'meta_description_uz' => $news->meta_description_uz,                'meta_description_kr' => $news->meta_description_kr,                'meta_description_ru' => $news->meta_description_ru,                'meta_keywords_uz' => $news->meta_keywords_uz,                'meta_keywords_kr' => $news->meta_keywords_kr,                'meta_keywords_ru' => $news->meta_keywords_ru,                 'tags_uz' => $news->tags_uz,                'tags_kr' => $news->tags_kr,                'tags_ru' => $news->tags_ru,                'image_detail' => $news->image_detail,                'image_index' => $news->image_index,                'image_grid' => $news->image_grid,                'status' => 1,            ]);            $time = time();            $beginDay = rand(-10, 20);            $endDay = $beginDay + rand(0, 15);            $n->begin = $time + $beginDay * 86400;            $n->end = $time + $endDay * 86400;            if (!$n->save()){                dd($n->errors);            }        }    }*/}