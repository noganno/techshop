<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => t('Reviews'), 'url' => ['blog/reviews']];
$this->params['breadcrumbs'][] = $this->title;

$this->metaTitle = $model->meta_title == '' ? $this->title : $model->meta_title;
$this->metaDescription = $model->meta_description;
$this->metaImage = $model->image_grid;
$this->metaKeywords = $model->meta_keywords;

?>


<div class="main-block-2 post">
    <div class="auto-container">
        <div class="post-banner">
            <div class="img">
                <img src="<?= $model->image_detail ?>" alt="<?= $model->title ?>">
            </div>
        </div>
        <div class="preview-page p-3 p-md-5">
            <div class="content">
                <h1 class="title"><?= Html::encode($model->title) ?></h1>

                <?= HtmlPurifier::process($model->content) ?>


                <?php if ($model->product != null): ?>
                    <?php
                            $product = $model->product;
                    ?>
                    <div class="review-product">
                        <a href="<?= url_to(['product/detail', 'id' => $product->slug]) ?>" class="name"><?= Html::encode($model->product->name) ?></a>
<!--                        <span class="yes-and-no-product my-2">Временно нету</span>-->
                        <p class="description">
                            <?= HtmlPurifier::process($product->description) ?>
                        </p>
                        <div class="properties">
                            <ul>
                                <li>
                                    <span><?= t('В рассрочку') ?></span>
                                    <b>
                                       <?= Yii::$app->formatter->asSum($product->loan_price) ?>
                                    </b>
                                </li>
                                <li>
                                    <span>Предоплата</span>
                                    <b>
                                        <span>250 000</span> сум
                                    </b>
                                </li>
                                <li>
                                    <span>В месяц по</span>
                                    <b>
                                        <span>20 000</span> сум
                                    </b>
                                </li>
                            </ul>
                            <div class="btns">
                                <button class="btn btn-yellow"><i class="fa fa-cart-arrow-down"></i>Купить в рассрочку
                                </button>
                                <button class="btn btn-balance"><i class="fa fa-balance-scale"></i></button>
                            </div>
                        </div>
                        <p class="comment mt-3">Предоплата на этот товар составляет <span>25</span>% —
                            <span>250 000</span> сум </p>
                    </div>
                <?php endif ?>


            </div>
            <a href="#" class="test-adever">
                <img src="/images/banner/test-reklama.png">
            </a>
        </div>
    </div>
</div>