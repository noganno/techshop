<?php

namespace frontend\controllers;

use soft\web\SController;
use Yii;

use common\models\Product;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * Cart controller
 */

class CartController extends SController

{

    public function actionRemoveFromCart()
    {
        $id = Yii::$app->request->get('id');
        Yii::$app->cart->remove($id);
        return $this->success();

    }

    public function actionAddToCart()
    {
        $id = $this->request->get('id');
        $count = $this->request->get('count', 1);
        $count = $count < 1 ? 1 : $count;
        $product = Product::findActiveOne($id);
        if($product != null){
            Yii::$app->cart->add($id, $count);
            return $this->success(t('Added to cart'));
        }
        else{
            return $this->error(t('Product not found'));
        }
    }


    /**
     * Actions for view cart page
     * */

    public function actionChangeCountOnCart()
    {

        $id = $this->request->get('id');
        $count = $this->request->get('count', 1);
        $count = $count < 1 ? 1 : $count;
        $product = Product::findActiveOne($id);
        if($product != null){
            Yii::$app->cart->changeQty($id, $count);
            return $this->success();
        }
        else{
            return $this->error(t('Product not found'));
        }
    }

    public function error($message=false)
    {
        if ($this->isAjax){
            return Json::encode([
                'success' => false,
                'message' => $message,
            ]);
        }
        else{
            if ($message){
                $this->setFlash('error', $message);
                return $this->back();
            }
        }
    }

    public function success($message=false)
    {
        if ($this->isAjax){
            return Json::encode([
                'success' => true,
                'message' => $message,
                'cartModalContent' => $this->renderAjax('@frontend/views/_partials/_cartModalContent.php'),
                'cartRassrochkaModalContent' => $this->renderAjax('@frontend/views/_partials/_cartRassrochkaModalContent.php'),
                'countItems' => Yii::$app->cart->countItems,
            ]);
        }
        else{
            if ($message){
                $this->setFlash('success', $message);
                return $this->back();
            }
        }
    }
}

?>