<?php

$products = Yii::$app->cart->products;
$hasItems = Yii::$app->cart->hasItems;
$totalSum = 0;
?>

<form class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">
            <?= t('Shopping cart') ?>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php if ($hasItems): ?>
        <div class="modal-body">
            <ul class="product-wrapper">
                <?php foreach (Yii::$app->cart->items as $id => $count): ?>

                    <?php if (isset($products[$id])): ?>
                        <?php $product = $products[$id] ?>
                        <li class="product-item" data-id="<?= $product->id ?>">
                            <div class="remove">
                                <span class="icon remove-from-cart" data-product-id="<?= $product->id ?>">×</span>
                            </div>
                            <div class="img">
                                <img src="<?= $product->getImage('cart') ?>">
                            </div>
                            <h1 class="name"><?= \yii\helpers\Html::encode($product->name) ?></h1>
                            <div class="count-product">
                                <span class="control minus minus-from-cart">-</span>
                                <span class="value" data-product-id="<?= $product->id ?>"><?= $count ?></span>
                                <span class="control plus plus-to-cart">+</span>
                            </div>
                            <span class="price">
                                <?php
                                $sum = $product->sale_price * $count;
                                $totalSum += $sum;
                                ?>

                                <?= Yii::$app->formatter->asSum($sum) ?>
                            </span>
                        </li>
                    <?php endif ?>


                <?php endforeach ?>
            </ul>

        </div>
        <div class="modal-footer">
            <div class="summ">
                <span class="text">Полная сумма:</span>
                <span class="summ-price">
                    <?= Yii::$app->formatter->asSum($totalSum) ?>
                </span>
            </div>
            <a href="<?= url_to(['shop/checkout']) ?>" class="btn btn-yellow-3"><?= Yii::t('app', 'Checkout') ?>
            </a>
            <a href="<?= url_to(['shop/rassrochka']) ?>"
               class="btn btn-yellow-3"><?= Yii::t('app', 'Оформить рассрочку') ?>
            </a>

            <!--<a href="<? /*= url_to(['shop/checkout']) */ ?>" <? /*= Yii::$app->user->isGuest ? 'data-toggle="modal" data-target="#login-modal"' : "" */ ?>
               class="btn btn-yellow-3"><? /*= Yii::t('app', 'Checkout') */ ?>
            </a>
            <a href="<? /*= url_to(['shop/rassrochka']) */ ?>" <? /*= Yii::$app->user->isGuest ? 'data-toggle="modal" data-target="#login-modal"' : "" */ ?>
               class="btn btn-yellow-3"><? /*= Yii::t('app', 'Оформить рассрочку') */ ?>
            </a>-->

            <button type="button" class="btn btn-white-2"
                    data-dismiss="modal"><?= t('Продолжить покупку') ?></button>
        </div>
    <?php else: ?>
        <?= \frontend\components\ModalBodyNoProductsWidget::widget() ?>
    <?php endif ?>
</form>