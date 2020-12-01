<?php


namespace frontend\components;


use frontend\models\Product;
use Yii;


class Cart extends \yii\base\Model

{


    public function getCountItems()
    {
        $count = 0;
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $pr_count) {
                $count += $pr_count;
            }
        }
        return $count;
    }

    public function getItems()

    {

        return Yii::$app->session->get('cart', []);

    }


    public function getHasItems()

    {

        return !empty($this->items);

    }


    public function add($id, $count = 1)

    {

        Yii::$app->session->open();
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] += $count;
        } else {
            $_SESSION['cart'][$id] = $count;
        }
    }

    public function remove($id)
    {
        Yii::$app->session->open();
        if (isset($_SESSION['cart'][$id])) {
            unset ($_SESSION['cart'][$id]);
        }
    }


    public function changeQty($id, $count = 1)

    {

        if ($count >= 1) {

            Yii::$app->session->open();

            $_SESSION['cart'][$id] = $count;

        }

    }

    public function clear()
    {
        Yii::$app->session->remove('cart');
    }

    public function getProducts()
    {
        $ids = array_keys($this->items);
        if (empty($ids)) {
            return [];
        }
        return Yii::$app->db->cache(function () use ($ids) {
            return Product::find()->active()->indexBy('id')->andWhere(['in', 'product.id', $ids])->with('category')->all();
        });
    }

    public function getFullPaymentAmount()
    {
        $sum = 0;

        foreach ($this->getProducts() as $product) {
            $sum += $product->sale_price;
        }

        return $sum;
    }

}