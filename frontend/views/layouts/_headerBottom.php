<?php

use yii\helpers\Url;
use frontend\models\Category;

$rootCategory = Category::find()->where(['id' => 1])->one();
$mainSubCategories = $rootCategory->subCategories;
?>


<!--Start hs Mega Menu-->
<nav class="hs-navigation">
    <ul class="nav-links">
        <?php foreach ($mainSubCategories as $category): ?>
            <?php $subCategories = $category->subCategories ?>
            <?php if (!empty($subCategories)): ?>
                <li class="has-child">
                    <span class="its-parent">
                        <?= $category->title ?>
                    </span>
                    <ul class="its-children">
                        <?php foreach ($subCategories as $subCategory): ?>
                            <?php $cats = $subCategory->subCategories; ?>
                            <?php if (!empty($cats)): ?>
                                <li class="has-child">
                                    <span class="its-parent"><?= $subCategory->title ?></span>
                                    <ul class="its-children">
                                        <?php foreach ($cats as $cat): ?>
                                            <li><a href="<?= $cat->detailUrl ?>"><?= $cat->title ?></a></li>
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li><a href="<?= $subCategory->detailUrl ?>"> <?= $subCategory->title ?> </a></li>
                            <?php endif ?>
                        <?php endforeach ?>
                    </ul>
                </li>
            <?php else: ?>
                <li><a href="<?= $category->detailUrl; ?>"><?= $category->title ?></a></li>
            <?php endif ?>
        <?php endforeach ?>
    </ul>
</nav>
<!--End hs Mega Menu-->

<div class="header-bottom ">
    <div class="auto-container">
        <ul class="menu">
            <?php foreach ($mainSubCategories as $category): ?>
                <li class="menu-item">
                    <a href="<?= $category->detailUrl; ?>"
                       class="menu-link"><?= $category->title; ?></a>
                    <div class="menu-item__megamenu">
                        <div class="megamenu-row">
                            <div class="megamenu-columns">

                                <?php
                                $subCategories = $category->subCategories;
                                ?>
                                <?php if (!empty($subCategories)): ?>
                                    <div class="megamenu-column">
                                    <?php foreach ($subCategories as $key => $subCategory) : ?>

                                        <?php if ($key == 0): ?>

                                            <div class="item">
                                                <a href="<?= $subCategory->detailUrl ?>"
                                                   class="megamenu-column_title">
                                                    <?= $subCategory->title ?>
                                                </a>
                                                <?php $cats = $subCategory->subCategories; ?>
                                                <?php if (!empty($cats)): ?>
                                                    <ul class="megamenu-column__category">
                                                        <?php foreach ($cats as $cat) : ?>
                                                            <li>
                                                                <a href="<?= $cat->detailUrl ?>"
                                                                   class="megamenu-column__category-link">
                                                                    <?= $cat->title ?>
                                                                </a>
                                                            </li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                <?php endif ?>
                                            </div>
                                        <?php elseif ($subCategory->position == 1): ?>
                                            </div> <!--close column-->
                                            <div class="megamenu-column"> <!--open new column-->
                                            <div class="item">
                                                <a href="<?= $subCategory->detailUrl ?>"
                                                   class="megamenu-column_title">
                                                    <?= $subCategory->title ?>
                                                </a>
                                                <?php $cats = $subCategory->subCategories; ?>
                                                <?php if (!empty($cats)): ?>
                                                    <ul class="megamenu-column__category">
                                                        <?php foreach ($cats as $cat) : ?>
                                                            <li>
                                                                <a href="<?= $cat->detailUrl ?>"
                                                                   class="megamenu-column__category-link">
                                                                    <?= $cat->title ?>
                                                                </a>
                                                            </li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                <?php endif ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="item">
                                                <a href="<?= $subCategory->detailUrl ?>"
                                                   class="megamenu-column_title">
                                                    <?= $subCategory->title ?>
                                                </a>
                                                <?php $cats = $subCategory->subCategories; ?>
                                                <?php if (!empty($cats)): ?>
                                                    <ul class="megamenu-column__category">
                                                        <?php foreach ($cats as $cat) : ?>
                                                            <li>
                                                                <a href="<?= $cat->detailUrl ?>"
                                                                   class="megamenu-column__category-link">
                                                                    <?= $cat->title ?>
                                                                </a>
                                                            </li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                <?php endif ?>
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                    </div> <!--close column-->
                                <?php endif ?>
                            </div>
                            <div class="img">
                                <?php if(isset($category->menu_image)) { ?>
                                    <img src="/thumb.php?src=<?= '/frontend/web'.$category->menu_image ?>&w=400">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
</div>