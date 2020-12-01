<?php

namespace frontend\controllers;

use common\models\CreditTypes;
use common\models\CreditTypesOptions;
use common\models\SpecialOffer;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;

use common\models\Category;
use common\models\Manufacturer;
use common\models\Mytable;
use common\models\Page;
use common\models\Product;
use common\models\Slider;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\LegalSignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;

class AjaxController extends Controller
{

    public function actionGetRassrochkaProductsSum()
    {
        $sum = 0;
        $products = Yii::$app->session->get('cart');
        if (!empty($products)){
            foreach ($products as $product) {
                $sum += Product::findOne($product['product_id'])->loan_price;
            }
        }
//        Yii::$app->response->format='json';
        return $sum;
    }

    public function actionGetCartProductsSum()
    {
        $sum = 0;
        $products = Yii::$app->session->get('cart');
        foreach ($products as $product) {
            $product = Product::findOne($product['product_id']);
            $sum += $product->sale_price ? $product->sale_price : $product->price;
        }
//        Yii::$app->response->format='json';
        return $sum;
    }

    public function actionGetValuesByCreditSelection($creditType, $creditOption)
    {
        $creditType = CreditTypes::findOne($creditType);
        $creditOption = CreditTypesOptions::findOne($creditOption);

        if ($creditType->bank) {

            return $creditOption->foiz." %";

        } else {

            $productsSum = $this->actionGetRassrochkaProductsSum();

            $creditOption = CreditTypesOptions::findOne($creditOption);

            $monthly = ($productsSum + ($productsSum * $creditOption->foiz) - ($productsSum * ($creditOption->deposit / 100))) / $creditOption->month;
            return Yii::t('app','oyiga')." ".$monthly." ".Yii::t('app','sum');

        }


    }


}