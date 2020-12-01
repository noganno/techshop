<?php

use frontend\models\Product;

$sale = Product::find()
    ->andWhere(['>', 'price', 0])
    ->active()
    ->with('categories')
    ->with('category')
    ->orderBy(['sale_price' => SORT_DESC])
//    ->latest(18)
    ->all();
?>

<div class="deals">
    <div class="auto-container">
        <div class="title-block">
            <h1 class="title"><?= Yii::t('app', 'bolshie_skidki') ?></h1>
            <ul class="filter-controls">
                <li data-filter="*" class="filter-controls__item active"><?= Yii::t('app', 'bolshie_skidki') ?></li>
                <li data-filter=".cat-1" class="filter-controls__item"><?= Yii::t('app', 'novinki') ?></li>
                <li data-filter=".cat-2" class="filter-controls__item"><?= Yii::t('app', 'We recommend') ?></li>
            </ul>
        </div>
        <div class="deals-cards">
            <?php foreach ($sale as $product) : ?>

                <div data-id='<?= $product->id ?>' class="products-cards__item <?= $product->isNew ? "cat-2" : "cat-1" ?>">
                    <a href="<?= $product->detailUrl ?>" class="img">
                        <span class="discount">
                            <?= floor(($product->price - $product->sale_price) * 100 / $product->sale_price) ?>%
                        </span>
                        <img src="<?= $product->getImage('card') ?>">
                    </a>
                    <div class="content">
                        <span class="category"><?= $product->getCategoryName(false) ?></span>
                        <a href="<?= $product->detailUrl ?>" class="name"><?= $product->name ?></a>
                        <span class="price">
                            <?= Yii::$app->formatter->asSum($product->sale_price) ?>
                        </span>
                        <span class="discount">
                            <?= Yii::$app->formatter->asSum($product->price) ?>
                        </span>
                        <span class="description">В месяц по 90 000 сум<br>Предоплата 10%</span>
                        <div class="btns">
                            <a href="#" class="btn btn-yellow-2 add-to-cart" data-product-id="<?= $product->id ?>"><i class="fa fa-cart-arrow-down"></i></a>
                            <a href="<?=\yii\helpers\Url::to(['balance/add-to-balance','id'=>$product->id])?>" class="btn btn-balance add-to-balance" data-product-id="<?= $product->id ?>"><i
                                        class="fa fa-balance-scale"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>