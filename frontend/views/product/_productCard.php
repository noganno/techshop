<?php

use yii\helpers\Html;

$attributeValues = $model->attributeValues;

$k = 1;

?>

<div class="products-cards__item bestseller_new_recommended">

    <?php if ($model->isNew): ?>
        <span class="product_new"><?= t('New') ?></span>
    <?php elseif ($model->isHit): ?>
        <span class="product_bestseller"><?= t('Hit sale') ?></span>
    <?php elseif ($model->isRecommend): ?>
        <span class="product_recommended"><?= t('Recommended') ?></span>
    <?php endif ?>

    <a href="<?= $model->detailUrl ?>" class="img">
        <img src="/thumb.php?src=<?= '/frontend/web'.$model->getImage('card') ?>&w=140&h=140&a=t&zc=3">
    </a>
    <div class="proporties">
        <span class="category"><?= $model->categoryName ?></span>
        <a href="<?= $model->detailUrl ?>" class="name">
            <?= ($model->name) ?>
        </a>

        <ul class="proporties-list">

            <?php if ($model->manufacturer != null): ?>
                <?php $k++; ?>
                <li class="proporties-item"><?= t('Manufacturer') ?>:
                    <span><?= ($model->manufacturer->name) ?></span>
                </li>
            <?php endif ?>
            <?php if($model->model != ''): ?>
                <?php $k++; ?>
                <li class="proporties-item"><?= t('Model') ?>:
                    <span><?= ($model->model) ?></span>
                </li>
            <?php endif ?>


            <?php if (!empty($attributeValues)): ?>

                <?php foreach ($attributeValues as $value): ?>

            <?php if ($value->attributeName->title != '' &&   $value->text != ''): ?>

                    <?php
                        if ($k > 4) break;
                        $k++;
                    ?>
                    <li class="proporties-item"><?= ($value->attributeName->title) ?>:
                        <span><?= ($value->text) ?></span>
                    </li>
                    <?php endif ?>

                <?php endforeach ?>
            <?php endif ?>

        </ul>

    </div>
    <div class="content">
        <span class="category">
            <?= ($model->categoryName) ?>
        </span>
        <a href="<?= $model->detailUrl ?>" class="name">
            <?= Html::encode($model->name) ?>
        </a>
        <h3 class="price"><?= Yii::$app->formatter->asSum($model->sale_price) ?></h3>
        <div class="btns">
            <span class="btn btn-yellow add-to-cart" data-product-id="<?= $model->id ?>">
                <?= Yii::$app->help->getCardSvg() ?>
                <?= t('Add to cart') ?>
            </span>
            <a href="<?= \yii\helpers\Url::to(['balance/add-to-balance', 'id' => $model->id]) ?>"
               class="btn btn-balance add-to-balance" data-product-id="<?= $model->id ?>">
                <?= Yii::$app->help->getBalanceSvg() ?>
            </a>
        </div>
    </div>
</div>