<?php


namespace frontend\controllers;


use common\models\Attribute;
use common\models\ProductAttribute;
use frontend\models\Product;
use yii;
use yii\web\Controller;

class BalanceController extends Controller
{

    public function actionIndex()
    {
        $ids = array_keys(Yii::$app->balance->getItems());
        $products = Product::findAll($ids);
        $attributes = Attribute::find()->joinWith('productAttributes')->andWhere(['product_attribute.product_id' => $ids])->all();
        return $this->render('index', [
            'products' => $products,
            'attributes' => $attributes,
        ]);
    }

    public function actionAddToBalance()
    {
        Yii::$app->response->format = 'json';
        $id = Yii::$app->request->get('id');
        Yii::$app->balance->add($id);

        return [
            'message' => Yii::t('app', 'Product succesfully added!'),
            'countItems' => Yii::$app->balance->getCountItems()
        ];

    }

    public function actionRemoveFromBalance()
    {
        $id = Yii::$app->request->get('id');
        Yii::$app->balance->remove($id);
        return $this->redirect(Yii::$app->request->referrer);
    }

}