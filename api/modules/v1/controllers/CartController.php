<?php

namespace api\modules\v1\controllers;

use common\models\Cart;
use common\models\Category;
use common\models\Product;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\HttpBearerAuth as AuthHttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\Response;

class CartController extends ActiveController
{

    public $modelClass = 'common\models\Cart';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'add' => ['post']
                ],
            ],
            'authenticator' => [
                'class' => HttpBearerAuth::class
            ]
        ];
    }


    public function actions()
    {
        $lang = Yii::$app->request->post('lang');
        Yii::$app->language = $lang;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex($lang)

    {
        return Category::mainCategories($lang);
    }

    public function actionAdd()
    {
        $product_id = Yii::$app->request->post('product_id');
        $quantity = Yii::$app->request->post('quantity');

        if (is_null($product_id)) {
            Yii::$app->response->statusCode = 400;
            return [
                'status' => 'error',
                'code' => 10,
                'message' => Yii::t('app', 'Product ID is null!')
            ];
        }
        if (is_null($quantity) || $quantity <= 0) {
            Yii::$app->response->statusCode = 400;
            return [
                'status' => 'error',
                'code' => 11,
                'message' => Yii::t('app', 'Quantity is null!')
            ];
        }

        if (!Product::findOne($product_id)) {
            Yii::$app->response->statusCode = 400;
            return [
                'status' => 'error',
                'code' => 11,
                'message' => Yii::t('app', 'Product is not found!')
            ];
        }
        $product = Cart::isProductInCart($product_id);

        if (!$product) {
            $cart = new Cart();
            $cart->user_id = Yii::$app->user->identity->id;
            $cart->product_id = $product_id;
            $cart->quantity = $quantity;
            $cart->save();

            return [
                'status' => 'success',
                'code' => 12,
                'message' => Yii::t('app', 'Product is added!'),
                'product_id'=>$product_id,
                'quantity'=>$product->quantity,
                'all_product_types_count'=>Cart::find()->where(['user_id'=>Yii::$app->user->identity->id])->count()
            ];
        } else {
            if ($product->quantity <= 0) {
                Cart::deleteAll(['product_id' => $product_id]);
                return [
                    'status' => 'success',
                    'code' => 13,
                    'message' => Yii::t('app', 'Product is deleted!')
                ];
            }
            $product->quantity += $quantity;
            $product->save();
            return [
                'status' => 'success',
                'code' => 12,
                'message' => Yii::t('app', 'Product is added!'),
                'product_id'=>$product_id,
                'quantity'=>$product->quantity,
                'products_count'=>Cart::find()->where(['user_id'=>Yii::$app->user->identity->id])->count()
            ];
        }


        return;
    }

    public function actionRemove()
    {
        $product_id = Yii::$app->request->post('product_id');

        if (is_null($product_id)) {
            Yii::$app->response->statusCode = 400;
            return [
                'status' => 'error',
                'code' => 10,
                'message' => Yii::t('app', 'Product ID is null!')
            ];
        }


        if (!Product::findOne($product_id)) {
            Yii::$app->response->statusCode = 400;
            return [
                'status' => 'error',
                'code' => 11,
                'message' => Yii::t('app', 'Product is not found!')
            ];
        }
        $product = Cart::isProductInCart($product_id);

        if (!$product) {
            
            return [
                'status' => 'error',
                'code' => 14,
                'message' => Yii::t('app', 'Product is not found in cart!')
            ];
        } else {
            if ($product->quantity != 1) {
                $product->quantity -= 1;
            }
             
            $product->save();
            return [
                'status' => 'success',
                'code' => 15,
                'message' => Yii::t('app', 'Product is decended!'),
                'product_id'=>$product_id,
                'quantity'=>$product->quantity,
                'all_product_types_count'=>Cart::find()->where(['user_id'=>Yii::$app->user->identity->id])->count()
            ];
        }

    }


    public function checkAccess($action, $model = null, $params = [])
    {
        // check if the user can access $action and $model
        // throw ForbiddenHttpException if access should be denied
        if ($action === 'update' || $action === 'delete') {
            if ($model->author_id !== \Yii::$app->user->id)
                throw new \yii\web\ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
        }
    }
}
