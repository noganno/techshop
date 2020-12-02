<?php


namespace backend\controllers;

use backend\components\Log;
use common\models\Product;
use common\models\ProductToSklad;
use common\models\Sklad;
use common\models\User;
use yii;
use yii\base\Controller;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

set_time_limit(3600);

class CmController extends Controller
{

//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => HttpBearerAuth::className(),
//        ];
//        return $behaviors;
//    }


    public function init()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::init();
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
                $this->newProductCount($pr, $sk, $count);
            } else {
                $this->updateProductCount($productCount, $count);
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
                $priceAmount = $priceObject->ЦенаВДокументе;

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


        try {
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
            }
        } catch (\Exception $e) {
            return $e->getMessage();
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
        $raw = Yii::$app->request->getRawBody();

//        Yii::error("xatolik");

        $body = json_decode($raw);

        try {
            foreach ($body as $user) {

                $newUser = new User();
                $newUser->username = $user->login;
                $newUser->setPassword($user->password);
                $newUser->guid = $user->guid;
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


    public function actionTestFile()
    {
        if (Yii::$app->request->isPost) {

            $file = UploadedFile::getInstanceByName('file');
            $newFile = $file->saveAs('@frontend/web/files/global/' . $file->baseName . "." . $file->extension);

            $url = \Yii::$app->request->hostInfo . "/files/global/" . $file->baseName . "." . $file->extension;
            return $url;

        }
    }


    public function actionGetSklads()
    {

        $sklads1C = Yii::$app->c1->getSklads();

        $sklads1C = json_decode($sklads1C);

        $sklads = ArrayHelper::map($sklads1C, 'УникальныйИдентификатор', 'Склад');
        $oldSklads = ArrayHelper::map(Sklad::find()->all(), 'unique_id', 'description');


//        print_r($oldSklads);

        $new = [];
        $new = array_diff_key($sklads, $oldSklads);

        return [
            'count_1c' => count($sklads1C),
            'count_local' => count($oldSklads),
            'count_new' => count($new)
        ];
    }


    public function actionUpdateNewSklads()
    {

        $sklads = Yii::$app->c1->getSklads();
        $oldSklads = Sklad::find()->asArray()->all();

        $a1 = (ArrayHelper::getColumn(json_decode($sklads), 'УникальныйИдентификатор'));
        $a2 = (ArrayHelper::getColumn($oldSklads, 'unique_id'));

//        dump($a1);
//        dump($a2);

        $updated = (array_intersect($a1, $a2));

        Sklad::deleteAll(['NOT IN', 'unique_id', $updated]);

        $sklads = Yii::$app->c1->getSklads();
        $oldSklads = Sklad::find()->asArray()->all();


        return [
//            'sklads' => $sklads,
//            'count_added' => count($addedSklads),
            'count_1c' => count(json_decode($sklads)),
            'count_local' => count($oldSklads),
//            'count_new' => count($updated)
        ];


    }


    public function actionGetUpdateProductsCount()
    {
        $store = Yii::$app->request->get('store');

        $products = Yii::$app->c1->getSkladProducts($store);

        if ($products) {
            $products = json_decode($products);
        } else {
            Yii::$app->response->statusCode = 404;
            return false;
        }


        return [
            'count_1c' => count($products),
        ];
    }

    public function actionUpdateNewProducts()
    {
        $store = Yii::$app->request->get('store');
        $sk = Sklad::findOne(['unique_id' => $store]);

        ProductToSklad::deleteAll(['sklad_id' => $sk->id]);

        if (!$sk) {
            $sk = new Sklad();
            $sk->unique_id = $store;
            $sk->description = "Aniqlanmagan";
            if (!$sk->save()) {
                return $sk->errors;
            }
        }


        $products = Yii::$app->c1->getSkladProducts($store);
//        $products = json_decode($products);

        $countNewProducts = 0;
        $countUpdated = 0;


        foreach ($products as $product) {
            $unique_id = $product->УникальныйИдентификатор;
            $name = $product->Номенклатура;
            $qty = $product->Остаток;

            $sale = (float)$product->ЦенаПродажа;
            $loan = (float)$product->ЦенаРассрочка;

            $pr = Product::findOne(['unique_id' => $unique_id]);

            if (!$pr) {

                $pr = new Product();
                $pr->unique_id = $unique_id;
                $pr->name_ru = $name;
                $pr->is_new_product = 1;
                $pr->detachBehavior('galleryBehavior');
                if (!$pr->save()) {
                    return $pr->errors;
                }
                $countNewProducts += 1;
            }

            try {

                $pr->sale_price = $sale;
                $pr->loan_price = $loan;
//                if ($product->ЦенаПродажа) {
//                }
//                if ($product->ЦенаРассрочка) {
//                }

                $pr->detachBehavior('galleryBehavior');

                if (!$pr->save()) {
                    return [
                        'error' => $pr->errors
                    ];
                }


                $productCount = ProductToSklad::findOne(['product_id' => $pr->id, 'sklad_id' => $sk->id]);
                if (!$productCount) {
                    $this->newProductCount($pr, $sk, $qty);
                } else {
                    $this->updateProductCount($productCount, $qty);
                }

                $countUpdated += 1;

                Yii::$app->obmenlog->createLog([
                    'name' => $name,
                    'guid' => $unique_id,
                    'action' => Log::ACTION_COUNT_CHANGE,
                    'wrote_to_site' => 1,
                    'sklad_id' => $sk->id,
                    'count' => $qty,
                ]);

            } catch (\Exception $e) {
                return $e->getMessage() . "<br>" . $pr->id;
            }
        }


        return [
            'count_1c' => count($products),
            'count_new' => $countNewProducts,
            'count_updated' => $countUpdated,
        ];
    }


    public function actionGetNewSklads()
    {

        $sklads = Yii::$app->c1->getSklads();
        $sklads = json_decode($sklads);

        $sklads = ArrayHelper::map($sklads, 'УникальныйИдентификатор', 'Склад');
        $oldSklads = ArrayHelper::map(Sklad::find()->all(), 'unique_id', 'description');


//        print_r($oldSklads);

        $new = [];

        $new = array_diff_key($sklads, $oldSklads);


        return $new;
    }

}
