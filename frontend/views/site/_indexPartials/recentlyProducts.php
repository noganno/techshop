<?php

use yii\helpers\Html;
use frontend\models\Product;

$products  = Yii::$app->recent->getProducts();

?>


<div class="products">
    <div class="auto-container">
        <?php if (!empty($products)): ?>
            <h1 class="title"><?= Yii::t('app', 'recently_viewed') ?></h1>
            <div class="products-cards__carousel owl-carousel owl-theme">
                <!-- Begin to display products for first carousel -->
                <?php foreach ($products as $model) : ?>
                    <div class="products-cards__item bestseller_new_recommended" data-id="<?= $model->id ?>">
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