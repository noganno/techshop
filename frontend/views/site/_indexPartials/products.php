<?php

// Товары которые чаще всего покупают в нашем магазине

use frontend\models\Product;
use soft\web\SView;
use yii\helpers\Html;

/** @var  $this SView */


$newProducts = Yii::$app->db->cache(function () {
    return Product::find()
        ->active()
        ->addOrderBy(['product.new_time' => SORT_DESC])
        ->andWhere(['>=', 'product.new_time', time() - 3 * 86400])
        //->limit(20)
        ->with('categories')
        ->with('category')
        ->distinct()
        ->all();
});



$recommendedProducts = Yii::$app->db->cache(function () {
    return Product::find()
        ->active()
        ->andWhere(['product.recommend' => 1])
       // ->limit(50)
        ->with('categories')
        ->with('category')
        ->all();
});

$hitProducts = Yii::$app->db->cache(function () {
    return Product::find()
        ->active()
       // ->limit(50)
        ->andWhere(['product.xit' => 1])
        ->with('categories')
        ->with('category')
        ->all();
});

$yellow_friday = Yii::$app->db->cache(function () {
    return Product::find()
        ->active()
        //->limit(50)
        ->andWhere(['product.yellow_friday' => 1])
        ->with('categories')
        ->with('category')
        ->all();
});



?>
<div class="products">
    <div class="auto-container">
        <?php if (!empty($hitProducts)): ?>
            <h1 class="title"><?= Yii::t('app', 'hamma_sotib_olyapti') ?></h1>
            <div class="products-cards__carousel owl-carousel owl-theme">
                <!-- Begin to display products for first carousel -->
                <?php foreach ($hitProducts as $model) : ?>
                    <div class="products-cards__item bestseller_new_recommended" data-id="<?= $model->id ?>">
                        <span class="product_bestseller"><?= t('Hit sale') ?></span>
                        <a href="<?= $model->detailUrl ?>" class="img">
                            <img src="/thumb.php?src=<?= '/frontend/web' . $model->getImage('card') ?>&w=140&h=140&a=t&zc=3">
                        </a>
                        <div class="content">
                            <span class="category"><?= Html::encode($model->categoryName) ?></span>
                            <a href="<?= $model->detailUrl ?>" class="name">
                                <?= $model->name ?>
                            </a>
                            <h3 class="price"><span><?= Yii::$app->formatter->asSum($model->sale_price) ?></span></h3>
                            <div class="btns">
                            <span href="#" class="btn btn-yellow add-to-cart" data-product-id="<?= $model->id ?>">
                               <?= Yii::$app->help->getCardSvg() ?>
                               <?= Yii::t('app', 'v_korzinu') ?>
                            </span>
                                <a href="<?= \yii\helpers\Url::to(['balance/add-to-balance', 'id' => $model->id]) ?>"
                                   class="btn btn-balance add-to-balance" data-product-id="<?= $model->id ?>">
                                    <?= Yii::$app->help->getBalanceSvg() ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- End to display products for first carousel -->
            </div>
        <?php endif ?>
        <?php if (!empty($recommendedProducts)): ?>
            <h1 class="title"><?= Yii::t('app', 'Recommended products') ?></h1>
            <div class="products-cards__carousel owl-carousel owl-theme">
                <!-- Begin to display products for first carousel -->
                <?php foreach ($recommendedProducts as $model) : ?>
                    <div class="products-cards__item bestseller_new_recommended" data-id="<?= $model->id ?>">
                        <span class="product_recommended"><?= t('Recommended') ?></span>
                        <a href="<?= $model->detailUrl ?>" class="img">
                            <img src="/thumb.php?src=<?= '/frontend/web' . $model->getImage('card') ?>&w=140&h=140&a=t&zc=3">
                        </a>
                        <div class="content">
                            <span class="category"><?= Html::encode($model->categoryName) ?></span>
                            <a href="<?= $model->detailUrl ?>" class="name">
                                <?= $model->name ?>
                            </a>
                            <h3 class="price"><span><?= Yii::$app->formatter->asSum($model->sale_price) ?></span></h3>
                            <div class="btns">
                            <span href="#" class="btn btn-yellow add-to-cart" data-product-id="<?= $model->id ?>">
                               <?= Yii::$app->help->getCardSvg() ?>
                               <?= Yii::t('app', 'v_korzinu') ?>
                            </span>
                                <a href="<?= \yii\helpers\Url::to(['balance/add-to-balance', 'id' => $model->id]) ?>"
                                   class="btn btn-balance add-to-balance" data-product-id="<?= $model->id ?>">
                                    <?= Yii::$app->help->getBalanceSvg() ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- End to display products for first carousel -->
            </div>
        <?php endif ?>
        <?php if (!empty($newProducts)): ?>
            <h1 class="title"><?= Yii::t('app', 'New products') ?></h1>
            <div class="products-cards__carousel owl-carousel owl-theme">
                <!-- Begin to display products for first carousel -->
                <?php foreach ($newProducts as $model) : ?>
                    <div class="products-cards__item bestseller_new_recommended" data-id="<?= $model->id ?>">
                        <span class="product_new"><?= t('New') ?></span>
                        <a href="<?= $model->detailUrl ?>" class="img">
                            <img src="/thumb.php?src=<?= '/frontend/web' . $model->getImage('card') ?>&w=140&h=140&a=t&zc=3">
                        </a>
                        <div class="content">
                            <span class="category"><?= Html::encode($model->categoryName) ?></span>
                            <a href="<?= $model->detailUrl ?>" class="name">
                                <?= $model->name ?>
                            </a>
                            <h3 class="price"><span><?= Yii::$app->formatter->asSum($model->sale_price) ?></span></h3>
                            <div class="btns">
                            <span href="#" class="btn btn-yellow add-to-cart" data-product-id="<?= $model->id ?>">
                               <?= Yii::$app->help->getCardSvg() ?>
                               <?= Yii::t('app', 'v_korzinu') ?>
                            </span>
                                <a href="<?= \yii\helpers\Url::to(['balance/add-to-balance', 'id' => $model->id]) ?>"
                                   class="btn btn-balance add-to-balance" data-product-id="<?= $model->id ?>">
                                    <?= Yii::$app->help->getBalanceSvg() ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- End to display products for first carousel -->
            </div>
        <?php endif ?>
        <?php if (!empty($yellow_friday)): ?>
            <h1 class="title"><?= Yii::t('app', 'Yellow Friday') ?></h1>
            <div class="products-cards__carousel owl-carousel owl-theme">
                <!-- Begin to display products for first carousel -->
                <?php foreach ($yellow_friday as $model) : ?>
                    <div class="products-cards__item bestseller_new_recommended" data-id="<?= $model->id ?>">
                        <span class="product_new product_yellow_friday"><?= t('Yellow Friday Badge') ?></span>
                        <a href="<?= $model->detailUrl ?>" class="img">
                            <img src="/thumb.php?src=<?= '/frontend/web' . $model->getImage('card') ?>&w=140&h=140&a=t&zc=3">
                        </a>
                        <div class="content">
                            <span class="category"><?= Html::encode($model->categoryName) ?></span>
                            <a href="<?= $model->detailUrl ?>" class="name">
                                <?= $model->name ?>
                            </a>
                            <h3 class="price"><span><?= Yii::$app->formatter->asSum($model->sale_price) ?></span></h3>
                            <div class="btns">
                            <span href="#" class="btn btn-yellow add-to-cart" data-product-id="<?= $model->id ?>">
                               <?= Yii::$app->help->getCardSvg() ?>
                               <?= Yii::t('app', 'v_korzinu') ?>
                            </span>
                                <a href="<?= \yii\helpers\Url::to(['balance/add-to-balance', 'id' => $model->id]) ?>"
                                   class="btn btn-balance add-to-balance" data-product-id="<?= $model->id ?>">
                                    <?= Yii::$app->help->getBalanceSvg() ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- End to display products for first carousel -->
            </div>
        <?php endif ?>
    </div>
</div>