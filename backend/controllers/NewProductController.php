<?php

namespace backend\controllers;

//<editor-fold desc="Use" defaultstate="collapsed">

use common\models\Attribute;
use common\models\behavior\AttributeValues;
use common\models\behavior\PCAssignBehavior;
use common\models\behavior\ProductToSkladBehavior;
use common\models\Product;
use common\models\ProductAttribute;
use common\models\ProductSearch;
use kartik\select2\Select2;
use soft\web\SController;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

// </editor-fold>


class NewProductController extends SController
{

    //<editor-fold desc="Crud actions" defaultstate="collapsed">
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

    public function actionIndex()
    {

        $searchModel = new ProductSearch();
        $searchModel->is_new_product = 1;
//        $searchModel->is_name_changed = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Product::findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Product();

        $model->attachBehaviors([

            [
                'class' => ProductToSkladBehavior::class,
            ],
            [
                'class' => PCAssignBehavior::class,
            ],
            [
                'class' => AttributeValues::class,
            ],

        ]);

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

    public function actionUpdate($id)
    {

        $model = Product::findModel($id);

        $model->attachBehaviors([

            [
                'class' => ProductToSkladBehavior::class,
            ],
            [
                'class' => PCAssignBehavior::class,
            ],
            [
                'class' => AttributeValues::class,
            ],

        ]);

        $ids = ArrayHelper::getColumn($model->categories, 'id');
        $model->categoryIds = implode(',', $ids);

        $attributes = Yii::$app->db->cache(function ($db) {
            return Attribute::find()->with('attributeGroup')->all();
        });

        $values_array = [];
        array_push($values_array, [
            'name' => 'attribute_id',
            'type' => Select2::class,
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map($attributes, 'id', 'title', 'attributeGroup.title')
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


        $model->sklad_values = $model->getProductToSklads()->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'attribute_form' => $values_array,
            'model' => $model,
        ]);
    }

    //</editor-fold>

    public function actionSelect($id = '')
    {
        $model = Product::findOne(['id' => $id, 'is_new_product' => 1]);
        if ($model == null) {
            not_found();
        }

        if ($model->load($this->post())) {
            return $this->redirect(['merge', 'id' => $id, 'select_id' => $model->selectedProductId]);
        }


        return $this->render('selectProduct', [
            'model' => $model,
        ]);
    }

    public function actionMerge($id = '', $select_id = '')
    {
        $newModel = Product::findOne(['id' => $id, 'is_new_product' => 1]);
        $model = Product::findOne($select_id);

        if ($newModel == null || $model == null || $model->is_new_product == 1) {
            not_found();
        }


        $model->unique_id = $newModel->unique_id;
        $model->name_uz = $newModel->name_uz;
        $model->name_ru = $newModel->name_ru;
        $model->name_kr = $newModel->name_kr;

        $model->description_uz = $newModel->description_uz;
        $model->description_ru = $newModel->description_ru;
        $model->description_kr = $newModel->description_kr;

        $model->sale_price = $newModel->sale_price;
        $model->loan_price = $newModel->loan_price;
        $model->price = $newModel->price;

        $model->attachBehaviors([

            [
                'class' => ProductToSkladBehavior::class,
            ],
            [
                'class' => PCAssignBehavior::class,
            ],
            [
                'class' => AttributeValues::class,
            ],

        ]);

        $ids = ArrayHelper::getColumn($model->categories, 'id');
        $ids2 = ArrayHelper::getColumn($newModel->categories, 'id');
        $allIds = array_merge_recursive($ids, $ids2);
        $allIds = array_unique($allIds);
        $model->categoryIds = implode(',', $allIds);

        $attributes = Yii::$app->db->cache(function ($db) {
            return Attribute::find()->with('attributeGroup')->all();
        });

        $values_array = [];
        array_push($values_array, [
            'name' => 'attribute_id',
            'type' => Select2::class,
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map($attributes, 'id', 'title', 'attributeGroup.title')
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

        $modelSkladValues = $model->getProductToSklads()->indexBy('sklad_id')->asArray()->all();
        $newModelSkladValues = $newModel->getProductToSklads()->indexBy('sklad_id')->asArray()->all();

        $model->sklad_values = array_merge($modelSkladValues, $newModelSkladValues);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $newModel->deleted = true;
            $newModel->save();

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'attribute_form' => $values_array,
            'model' => $model,
        ]);

    }


    public function actionProductList($q = null, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'name' => '']];
        if (!is_null($q)) {
            $data = Product::find()
                ->joinWith('translations')
                ->where(['like', 'product_lang.name', $q])
                ->andWhere(['product_lang.language' => Yii::$app->language])
                ->andWhere(['!=', 'product.is_new_product', 1])
                ->limit(20)
                ->all();
            if (!empty($data)) {
                $out['results'] = $data;
            }
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'name' => Product::findOne($id)->name];
        }
        return $out;
    }


    public function actionAddToMain($id = '')
    {
        $model = Product::findOne(['id' => $id, 'is_new_product' => 1]);
        if ($model == null) {
            not_found();
        }

        $model->is_new_product = 0;
        $model->new_time = time();
        $model->save();
        $this->setFlash('success', $model->name . " - " . t('Product has been added to main products'));
        return $this->redirect('index');
    }


}
