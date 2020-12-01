<?php

namespace console\controllers;

use common\models\Mytable;
use common\models\ProductToSklad;
use common\models\Sklad;
use console\models\PLang;
use console\models\PLangClone;
use console\models\Product;
use Yii;
use yii\console\Controller;
use yii\helpers\FileHelper;
use yii\helpers\Json;

class SyncController extends Controller
{

    public function actionStart($message = 'hello world')
    {
        $products = Mytable::find()->indexBy('id')->all();
        $time0 = date('U');
        $i = 1;
        foreach ($products as $product) {
            $newProduct = new Product();
            $newProduct->name_ru = $product->name;
            $newProduct->name_uz = $product->name;
            $newProduct->name_kr = $product->name;
            $newProduct->unique_id = $product->id;
            $newProduct->sklad_id = $product->id_sklad;
            $newProduct->status = 0;
            $newProduct->quantity = $product->qty;
            $newProduct->loan_price = $product->loan_price;
            $newProduct->sale_price = $product->price;
            $newProduct->save();
            echo (date('U') - $time0) . " sec. id = " . $i++ . "\n";
        }
    }

    public function actionCreate($message = 'hello world')
    {
        echo $message . "\n";
    }

    public function actionCreateSklad()
    {
        $sklads = Mytable::find()->indexBy('id_sklad')->all();
        $time0 = date('U');
        foreach ($sklads as $sklad) {
//            print_r($sklad);
            $newsklad = new Sklad();
            $newsklad->unique_id = $sklad->id_sklad;
            $newsklad->description_ru = $sklad->sklad;
            $newsklad->description_uz = $sklad->sklad;
            $newsklad->description_kr = $sklad->sklad;
            $newsklad->save();
        }

        echo "Ended in " . (date('U') - $time0) . " seconds.";

    }

    public function actionTest()
    {
        $total = Mytable::find()->indexBy('id')->all();

//        echo count($total);
        print_r($total);

    }


    public function actionGoods()
    {

        $file = Yii::getAlias('@console/views/getGoods.json');
        $json = file_get_contents($file);
        $array = Json::decode($json);
        $sklads = $array['goods'];

        foreach ($sklads as $sklad) {


            $ns = Sklad::findOne([
                'unique_id' => $sklad['УникальныйИдентификаторСклад']
            ]);


            if ($ns == null) {

                $ns = new Sklad();
                $ns->description_ru = $sklad['Склад'];
                $ns->description_kr = $sklad['Склад'];
                $ns->description_uz = $sklad['Склад'];

                $ns->unique_id = $sklad['УникальныйИдентификаторСклад'];
                $ns->status = 1;

                if (!$ns->save()) {
                    print_r($ns->errors);
                    die();
                }

            }


            $goods = $sklad['Остатки'];

            foreach ($goods as $good) {

                $product = Product::findOne(['unique_id' => $good['УникальныйИдентификатор']]);
                if ($product == null) {
                    $product = new Product([

                        'unique_id' => $good['УникальныйИдентификатор'],
                        'name_ru' => $good['Номенклатура'],
                        'name_kr' => $good['Номенклатура'],
                        'name_uz' => $good['Номенклатура'],
                        'sale_price' => $good['ЦенаПродажа'],
                        'loan_price' => $good['ЦенаРассрочка'],

                    ]);
                }


                if ($product->save()) {

                    $assign = new ProductToSklad([
                        'product_id' => $product->id,
                        'sklad_id' => $ns->id,
                        'quantity' => $good['Остаток'] < 0 ? 0 : $good['Остаток'],
                    ]);

                    if (!$assign->save()) {
                        print_r($assign->errors);
                        die();
                    }

                    if (!$product->isNewRecord) {
                        PLang::deleteAll(['owner_id' => $product->id]);
                        $product->save();
                    }

                } else {
                    print_r($product->errors);
                    die();
                }
            }
        }
    }

    public function actionSaveLangs()
    {


        $file = Yii::getAlias('@console/views/getGoods.json');
        $json = file_get_contents($file);
        $array = Json::decode($json);
        $sklads = $array['goods'];

        foreach ($sklads as $sklad) {

            $ns = Sklad::findOne([
                'unique_id' => $sklad['УникальныйИдентификаторСклад']
            ]);

            if ($ns == null) {

                $ns = new Sklad();
                $ns->description_ru = $sklad['Склад'];
                $ns->description_kr = $sklad['Склад'];
                $ns->description_uz = $sklad['Склад'];

                $ns->unique_id = $sklad['УникальныйИдентификаторСклад'];
                $ns->status = 1;
                $ns->save();

            }


            $goods = $sklad['Остатки'];

            foreach ($goods as $good) {

                $product = Product::findOne(['unique_id' => $good['УникальныйИдентификатор']]);
                if ($product == null) {
                    $product = new Product([

                        'unique_id' => $good['УникальныйИдентификатор'],
                        'name_ru' => $good['Номенклатура'],
                        'name_kr' => $good['Номенклатура'],
                        'name_uz' => $good['Номенклатура'],
                        'sale_price' => $good['ЦенаПродажа'],
                        'loan_price' => $good['ЦенаРассрочка'],

                    ]);
                }


                if ($product->save()) {

                    $id = $product->id;

                    $assign = new ProductToSklad([
                        'product_id' => $product->id,
                        'sklad_id' => $ns->id,
                        'quantity' => $good['Остаток'] < 0 ? 0 : $good['Остаток'],
                    ]);

                    $assign->save();


                    $this->saveLangss($id, $good['Номенклатура']);


                } else {
//                    print_r($product->errors);
                }
            }
        }

    }

    public function actionSaveCost()
    {

        $file = Yii::getAlias('@console/views/getGoods.json');
        $json = file_get_contents($file);
        $array = Json::decode($json);
        $sklads = $array['goods'];

        foreach ($sklads as $sklad) {
            $goods = $sklad['Остатки'];
            foreach ($goods as $good) {

                $product = Product::findOne(['unique_id' => $good['УникальныйИдентификатор']]);
                if ($product == null) {
                    $product = new Product([
                        'unique_id' => $good['УникальныйИдентификатор'],

                    ]);
                }
                $product->name_ru = $good['Номенклатура'];
                $product->name_kr = $good['Номенклатура'];
                $product->name_uz = $good['Номенклатура'];
                $product->sale_price = $good['ЦенаПродажа'];
                $product->loan_price = $good['ЦенаРассрочка'];

                if (!$product->save()) {
                    print_r($product->errors);
                    echo $product->unique_id . "\n";
                }
            }
        }
    }

    public function actionProductSave()
    {
        $p = new Product([

            'unique_id' => 'УникальныйИдентификатор',
            'name_ru' => 'Номенклатура',
            'name_kr' => 'Номенклатура',
            'name_uz' => 'Номенклатура',
            'sale_price' => 1000,
            'loan_price' => 1000,

        ]);
        if (!$p->save()) {
            print_r($p->errors);
        }
    }


    public function actionLangs()
    {

        $products = Product::find()->all();
        foreach ($products as $product) {

            $id = $product->id;
            $name = PLangClone::find()->where(['owner_id' => $id])->one();


            if ($name == null) {
                echo "Not found: - " . $id . " - " . $product->slug;
            } else {

                $lang = new PLang();
                $lang->owner_id = $id;
                $lang->name = $name->name;
                $lang->language = 'ru';
                if (!$lang->save()) {
                    print_r($lang->errors);
                }

                $lang = new PLang();
                $lang->owner_id = $id;
                $lang->name = $name->name;
                $lang->language = 'kr';
                if (!$lang->save()) {
                    print_r($lang->errors);
                }

                $lang = new PLang();
                $lang->owner_id = $id;
                $lang->name = $name->name;
                $lang->language = 'uz';
                if (!$lang->save()) {
                    print_r($lang->errors);
                }

            }

        }

    }


    /*    public function actionDeleteLangs()
        {
            PLang::deleteAll([">=", 'id', 113813]);
        }*/


    public function saveLangss($id, $name)
    {

        $langRu = PLang::findOne([
            'owner_id' => $id,
            'language' => 'ru'
        ]);
        if ($langRu == null) {
            $langRu = new PLang();
            $langRu->owner_id = $id;
            $langRu->language = 'ru';
        }
        $langRu->name = $name;
        if (!$langRu->save()) {
//            print_r($langRu->errors);
        }


        $langUz = PLang::findOne([
            'owner_id' => $id,
            'language' => 'uz'
        ]);
        if ($langUz == null) {
            $langUz = new PLang();
            $langUz->owner_id = $id;
            $langUz->language = 'uz';
        }
        $langUz->name = $name;
        if (!$langUz->save()) {
//            print_r($langUz->errors);
        }


        $langKr = PLang::findOne([
            'owner_id' => $id,
            'language' => 'kr'
        ]);
        if ($langKr == null) {
            $langKr = new PLang();
            $langKr->owner_id = $id;
            $langKr->language = 'kr';
        }
        $langKr->name = $name;
        if (!$langKr->save()) {
//            print_r($langKr->errors);
        }


    }

}
