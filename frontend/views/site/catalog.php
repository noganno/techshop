<?php

use yii\helpers\Html;
use common\models\Category;

$this->title = $category->name;
$this->metaTitle = $category->getMetaTitle();
$this->metaImage = $category->getMetaImage();
$this->metaDescription = $category->getMetaDescription();
$this->metaKeywords = $category->getMetaKeywords();
Yii::$app->session->set('currentCategoryId', $category->id);

$this->params['breadcrumbs'][] = t('Catalog');


?>

<!-- Start of .main-block-2 -->
<div class="main-block-2 categories">
    <div class="auto-container">
        <div class="categories-wrapper" style="width: 100%;">
            <?php foreach ($subCategories as $category): ?>
                <div class="item">
                    <div class="icon">
                        <img src="<?= $category->image ?>" style="height: 50px">
                    </div>
                    <a href="<?= $category->detailUrl ?>" class="title">
                        <?= Html::encode($category->name) ?>
                    </a>

                    <?php
                    $cats = $category->subCategories;
                    ?>

                    <?php if (!empty($cats)): ?>
                        <ul class="links">
                            <?php foreach ($cats as $cat): ?>
                                <li class="item">
                                    <a href="<?= $cat->detailUrl ?>" class="link">
                                        <?= Html::encode($cat->name) ?>
                                        (<span><?= count($cat->activeProducts) ?></span>)
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif ?>

                </diV>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- End of .main-block-2 -->