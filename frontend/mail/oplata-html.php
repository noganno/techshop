<?php

use yii\helpers\Html;

$cart = Yii::$app->cart;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<div class="verify-email">

    <h3>Полная оплата: new texnomart.uz</h3>
    <?php foreach ($products as $product): ?>
        ------------------------------------------
        <p>Товар: <?= $product->name ?></p>
        <p>Стоимость: <?= $product->sale_price ?></p>
        <p>Количество: <?= isset($cart->items[$product->id]) ? $cart->items[$product->id] : 1; ?></p>
    
    <?php endforeach; ?>
    ------------------------------------------
    <p>Ф.И.О.: <?= $name ?></p>
    <p>Телефон: <?= $tel ?></p>
</div>