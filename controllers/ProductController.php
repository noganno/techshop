<?php

namespace backend\controllers;

use common\models\Attribute;
use common\models\Product;
use common\models\ProductAttribute;
use common\models\ProductSearch;
use kartik\select2\Select2;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actions()
    {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'product' => Product::className()
                ]
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $searchModel->is_new_product = 0;
        $searchModel->deleted = 0;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        $values_array = [];
        array_push($values_array, [
            'name' => 'attribute_id',
            'type' => Select2::class,
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(Attribute::find()->all(), 'id', 'title', 'attributeGroup.title')
            ],
            'title' => Yii::t('app', 'Attribute Name'),
            'defaultValue' => 1,

        ]);
        foreach (Yii::$app->params['languages'] as $key => $value) {
            array_push($values_array, [
                'name' => 'attribute_value_' . $key,
                'title' => Yii::t('app', 'Attribute') . " " . $value,
                'enableError' => true,
                'options' => [
                    'class' => 'input-priority'
                ]
            ]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'attribute_form' => $values_array
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        $ids = ArrayHelper::getColumn($model->categories, 'id');
        $model->categoryIds = implode(',', $ids);

        $values_array = [];
        array_push($values_array, [
            'name' => 'attribute_id',
            'type' => Select2::class,
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(Attribute::find()->all(), 'id', 'title', 'attributeGroup.title')
            ],
            'title' => Yii::t('app', 'Attribute Name'),
            'defaultValue' => 1,
        ]);
        foreach (Yii::$app->params['languages'] as $key => $value) {
            array_push($values_array, [
                'name' => 'attribute_value_' . $key,
                'title' => Yii::t('app', 'Attribute  ' . $value),
                'enableError' => true,
                'options' => [
                    'class' => 'input-priority'
                ]
            ]);
        }

        $attributes = ProductAttribute::find()->where(['product_id' => $model->id])->all();
        $temp_attributes = ProductAttribute::find()->where(['product_id' => $model->id])->andWhere(['language' => 'ru'])->all();
        function langValue($attributes, $attribute_id, $id)
        {
            foreach ($attributes as $attribute) {
                if ($attribute->language == $id && $attribute_id == $attribute->attribute_id) {
                    return $attribute->text;
                }
            }
        }

        $aa = [];
        foreach ($temp_attributes as $attribute) {
            $temp_array = [];
            $temp_array['attribute_id'] = $attribute->attribute_id;
            foreach (Yii::$app->params['languages'] as $key => $value) {
                $temp_array['attribute_value_' . $key] = langValue($attributes, $attribute->attribute_id, $key);
            }
            array_push($aa, $temp_array);
        }
        $model->attribute_values = $aa;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'attribute_form' => $values_array,
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


}
