<?php

/* @var $this yii\web\View */

$this->title = t('Home');

use common\models\Product;

$countNewProducts = Product::find()->where(['is_new_product' => 1])->andWhere(['=', 'deleted', 0])->count();
$countEmptyCategoryProducts = Product::find()->joinWith('categories')->andWhere(['=', 'deleted', 0])->andWhere(['category.id' => null])->andWhere(['is_new_product' => 0])->count();
$countNameChangedProducts = Product::find()->andWhere(['is_name_changed' => 1])->andWhere(['is_new_product' => 0])->count();


?>
<div class="site-index">


    <h1><?= t('Welcome') ?></h1>

    <p class="lead"><?= t('Texnomart saytining boshqaruv paneliga xush kelibsiz') ?></p>


    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $countNewProducts ?></h3>

                    <p><?= t('New products') ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-plus"></i>
                </div>
                <a href="<?= url_to(['/new-product']) ?>" class="small-box-footer"><?= t('View') ?>
                    <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= $countEmptyCategoryProducts ?></h3>

                    <p><?= t('Products which has no category') ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="<?= url_to(['/product', 'emptyCategory' => true]) ?>" class="small-box-footer"><?= t('View') ?>
                    <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $countNameChangedProducts ?></h3>

                    <p><?= t('Products that name has been changed') ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-file-text-o"></i>
                </div>
                <a href="<?= url_to(['/product', 'is_name_changed' => 1]) ?>"
                   class="small-box-footer"><?= t('View') ?>
                    <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>


    <!--    <p><a class="btn btn-lg btn-success" href="--><? //= url_to('site/home') ?><!--">-->
    <? //= t('Go Basic page') ?><!--</a></p>-->

</div>

<!--<style>
    .site-index {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 70vh;
    }
</style>-->