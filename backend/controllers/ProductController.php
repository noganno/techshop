<?php

namespace backend\controllers;

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
use zxbodya\yii2\galleryManager\GalleryManagerAction;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends SController
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
                'types' => [
                    'product' => Product::className()
                ]
            ],
        ];
    }

    //<editor-fold desc="Index" defaultstate="collapsed">

    public function actionIndex()
    {

        $title = t('Products');

        $searchModel = new ProductSearch();

        if (Yii::$app->request->get('emptyCategory')) {
            $searchModel->emptyCategory = Yii::$app->request->get('emptyCategory');
            $searchModel->is_new_product = 0;

            $title = t('Без категории');

        }

        if (Yii::$app->request->get('is_name_changed')) {
            $searchModel->is_name_changed = 1;
            $searchModel->is_new_product = 0;
            $title = t('Переименованные');

        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => $title
        ]);
    }

// </editor-fold>
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Product::findModel($id),
        ]);
    }

    //<editor-fold desc="Create" defaultstate="collapsed">

    public function actionCreate()
    {
        $model = new Product();
        $model->is_new_product = 0;

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

// </editor-fold>
    //<editor-fold desc="Update" defaultstate="collapsed">

    public function actionUpdate($id)
    {

        $model = Product::findModel($id);
        $model->is_name_changed = 0;

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
                    //'readOnly' => true,
                    'class' => 'input-priority disabled'
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


// </editor-fold>

    public function actionBulkCategory()
    {
        if ($this->getIsAjax()) {

            $this->formatJson;
            $model = new Product([
                'scenario' => 'bulk-category'
            ]);
            $pks = $this->post('pks');
            if ($model->load($this->post())) {
                $ids = explode(',', $pks);
                $products = Product::findAll($ids);
                foreach ($products as $product) {
                    $product->categoryIds = $model->categoryIds;
                    $product->attachBehaviors([
                        [
                            'class' => PCAssignBehavior::class,
                        ],
                    ]);
                    $product->save();
                }
                return ['forceReload' => '#crud-datatable-pjax', 'forceClose' => true];

            }

            return [

                'title' => t('Select categories'),
                'content' => $this->renderAjax('selectCategories', [
                    'model' => $model,
                    'pks' => $pks,
                ]),
                'footer' => Yii::$app->help->modalFooter,

            ];

        }


    }

}
