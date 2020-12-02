<?php

namespace api\modules\v1\controllers;

use backend\components\Log;
use common\models\Product;
use common\models\ProductToSklad;
use common\models\Sklad;
use common\models\User;
use yii;
use yii\base\Controller;


set_time_limit(3600);

class CmController extends Controller
{


//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//        $behaviors['basicAuth'] = [
//            'class' => \yii\filters\auth\HttpBasicAuth::className(),
//            'auth' => function ($username, $password) {
//
//                $user = User::find()->where(['username' => $username])->one();
//                if ((Yii::$app->getSecurity()->validatePassword($password, $user->password_hash))) {
//                    return $user;
//                }
//                throw new yii\web\UnauthorizedHttpException;
//            },
//        ];
//        return $behaviors;
//    }


    public function init()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        \Yii::$app->user->enableSession = false;
        return parent::init();
    }

    public function actionTest()
    {
        return 1;
    }

    public function actionUpdateSkladCount()
    {
        $body = Yii::$app->request->getRawBody();

        $body = json_decode($body);


        foreach ($body as $update_product) {

            $name = $update_product->Номенклатура;
            $unique_id = $update_product->UIDНомеклатура;
            $sklad = $update_product->Склад;
            $sklad_id = $update_product->UIDСклад;
            $count = $update_product->Остаток;

            $pr = Product::findOne(['unique_id' => $unique_id]);

            $sk = Sklad::findOne(['unique_id' => $sklad_id]);

            if (!$pr) {
                $pr = new Product();
                $pr->unique_id = $unique_id;
                $pr->name_ru = $name;
                $pr->status = 0;
                $pr->is_new_product = 1;
                if (!$pr->save()) {
                    return $pr->errors;
                }
            }

            if (!$sk) {
                $sk = new Sklad();
                $sk->unique_id = $sklad_id;
                $sk->description = $sklad;
                if (!$sk->save()) {
                    return $sk->errors;
                }
            }


            $productCount = ProductToSklad::findOne(['product_id' => $pr->id, 'sklad_id' => $sk->id]);


            if (!$productCount) {
                $res = $this->newProductCount($pr, $sk, $count);
            } else {
                $res = $this->updateProductCount($productCount, $count);
            }

            if ($res['status']) {
                Yii::$app->obmenlog->createLog([
                    'name' => $name,
                    'guid' => $unique_id,
                    'action' => Log::ACTION_COUNT_CHANGE,
                    'wrote_to_site' => 1,
                    'is_from_1c' => 1,
                    'sklad_id' => $sk->id,
                    'count' => $count,
                ]);
            }


        }

        return true;
    }

    public function actionUpdateProductPrices()
    {
        $body = Yii::$app->request->getRawBody();

        $body = json_decode($body);

        foreach ($body as $priceObject) {

            $unique_id = $priceObject->UIDНомеклатура;
            $name = $priceObject->Номенклатура;
            $pr = Product::findOne(['unique_id' => $unique_id]);

            if (!$pr) {

                $pr = new Product();
                $pr->unique_id = $unique_id;
                $pr->name_ru = $name;
                $pr->is_new_product = 1;
                if (!$pr->save()) {
                    return $pr->errors;
                }
            }

            try {
                $type = $priceObject->ВидЦены;
                $priceAmount = (float)$priceObject->ЦенаВДокументе;

                if ($type == "Полная оплата") {
                    $pr->sale_price = $priceAmount;
                }
                if ($type == "В рассрочку") {
                    $pr->loan_price = $priceAmount;
                }

                if (!$pr->save()) {
                    return [
                        'error' => $pr->errors
                    ];
                }

                Yii::$app->obmenlog->createLog([
                    'name' => $name,
                    'guid' => $unique_id,
                    'sale_price' => $pr->sale_price,
                    'loan_price' => $pr->loan_price,
                    'action' => Log::ACTION_PRICE_CHANGE,
                    'wrote_to_site' => 1,
                    'is_from_1c' => 1,
                ]);

            } catch (\Exception $e) {
                return true;
            }

        }

        return true;

    }

    public function actionUpdateProductNames()
    {
        $raw = Yii::$app->request->getRawBody();

        $body1 = json_decode($raw);

        foreach ($body1 as $body) {
            $unique_id = $body->UIDНомеклатура;
            $name_ru = $body->Номенклатура;

            $pr = Product::findOne(['unique_id' => $unique_id]);

            if (!$pr) {
                $pr = new Product();
                $pr->unique_id = $unique_id;
                $pr->status = 0;
                $pr->is_new_product = 1;
            }
            $pr->name_ru = $name_ru;
            $pr->is_name_changed = 1;
            if (!$pr->save()) {
                return $pr->errors;
            }
            Yii::$app->obmenlog->createLog([
                'name' => $pr->name,
                'guid' => $pr->unique_id,
//                'sale_price' => $pr->sale_price,
//                'loan_price' => $pr->loan_price,
                'action' => Log::ACTION_NAME_CHANGE,
                'wrote_to_site' => 1,
                'is_from_1c' => 1,
            ]);
        }


        return true;

    }

    public function updateProductCount($productCount, $count)
    {
        $productCount->quantity = $count;
        if ($productCount->save()) {
            return [
                'status' => true,
                'sklad_id' => $productCount->sklad->unique_id,
                'product_id' => $productCount->product->unique_id,
                'count' => $productCount->quantity
            ];
        } else {
            return [
                "message" => "Something went wrong."
            ];
        }
    }

    public function newProductCount($pr, $sk, $quantity)
    {

        $newProductCount = new ProductToSklad();
        $newProductCount->product_id = $pr->id;
        $newProductCount->sklad_id = $sk->id;
        $newProductCount->quantity = $quantity;

        if ($newProductCount->save()) {
            return [
                'status' => true,
                'sklad_id' => $newProductCount->sklad->unique_id,
                'product_id' => $newProductCount->product->unique_id,
                'count' => $newProductCount->quantity
            ];
        } else {
            return [
                'error' => $newProductCount->errors
            ];
        }


        return $pr;
    }


    public function actionNewUser()
    {


//        return Yii::$app->request->authCredentials;

        $raw = Yii::$app->request->getRawBody();

//        Yii::error("xatolik");

        $body = json_decode($raw);

        try {
            foreach ($body as $user) {

                $newUser = new User();
                $newUser->username = $user->login;
                $newUser->setPassword($user->password);
                $newUser->guid = $user->guid;
                $newUser->password_str = $user->password;
                $newUser->user_type = 0;
                $newUser->phone = $user->phone;
                $newUser->status = 10;
                $newUser->generateAuthKey();
                $newUser->name = $user->first_name;
                $newUser->surname = $user->last_name;
                $newUser->father_name = $user->middle_name;
                $newUser->save();
            }
        } catch (\Exception $e) {
            Yii::$app->response->statusCode = 400;
            return false;
        }
        return true;

    }
}
