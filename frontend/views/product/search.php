<?php

use frontend\models\Category;

$this->title = t("Search results");
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="main-block filter-product">
    <?php if ($dataProvider->getCount() > 0): ?>


        <div class="auto-container container_left-sidebar-2">
            <div class="article" style="max-width: 100%!important;">
                <div class="product-wrapper-top">
                    <div class="wrapper-block">

                        <p class="inner-block-min" style="width: auto; max-width: 100%">
                        <span class="h4">
                            <?= $this->title ?>:
                            <span class="text-info"><?= e(Yii::$app->request->get('key')) ?></span>

                        </span>
                        </p>
                    </div>
                </div>
                <div class="product-wrapper-top">
                    <div class="wrapper-block">

                        <p class="inner-block-min" id="product-group-sort-icon">
                            <span><?= t('Вид') ?>:</span>
                            <i class="fa fa-th-list"></i>
                            <i class="fa fa-th-large active"></i>
                        </p>
                    </div>
                </div>
                <div class="product-wrapper-bottom th-large" id="product-group-sort-wrapper">
                    <?php foreach ($dataProvider->getModels() as $model): ?>
                        <?= $this->render('_productCard', ['model' => $model]); ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <?= \frontend\components\TexnomartLinkPager::widget(['pagination' => $dataProvider->getPagination()]) ?>


    <?php else: ?>

    <div class="auto-container container_left-sidebar-2" style="min-height: 500px">
        <div class="article" style="max-width: 100%!important;">
            <div class="product-wrapper-top">
                <div class="wrapper-block">

                    <p class="inner-block-min" style="width: 100%; max-width: 100%">
                        <span class="h4">
                            <?= $this->title ?>:
                            <span class="text-info"><?= e(Yii::$app->request->get('key')) ?></span>
                            <br>
                            <br>
                            <br>
                            <span class="h6"><?= t('We are sorry, but nothing was found.') ?></span>
                        </span>

                </div>
            </div>
        </div>
    </div>

    <?php endif ?>
</div>
