<?php


namespace frontend\components;

use Yii;

use soft\helpers\SArray;


class Balance extends \yii\base\Model

{


    public function getCountItems()
    {
        $count = 0;
        if(isset($_SESSION['balance'])  && !empty($_SESSION['balance']) ){
            $count = count($_SESSION['balance']);
        }
        return $count;
    }

    public function getItems()

    {

        return Yii::$app->session->get('balance', []);

    }



    public function getHasItems()

    {

        return !empty($this->items);

    }



    public function add($id, $count = 1)

    {

        Yii::$app->session->open();
        if(isset($_SESSION['balance'][$id])){
            $_SESSION['balance'][$id] += $count;
        }
        else{
            $_SESSION['balance'][$id] = $count;
        }
    }

    public function remove($id)
    {
        Yii::$app->session->open();
        if(isset($_SESSION['balance'][$id])){
            unset ($_SESSION['balance'][$id]);
        }
    }


    public function changeQty($id, $count=1)

    {

        if ($count >= 1){

            Yii::$app->session->open();

            $_SESSION['balance'][$id] = $count;

        }

    }

    public function clear()
    {
        Yii::$app->session->remove('balance');
    }

}