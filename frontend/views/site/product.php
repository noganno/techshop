<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>


<!-- Start of .main-block -->
<div class="main-block product-page">
    <div class="auto-container">
        <!-- Start of .product-page__info -->
        <div class="product-page__info" data-id="<?= $product->id ?>">
            <div class="img">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <?php $i = 0; ?>
                    <?php foreach ($product->getImages('card') as $image) : ?>
                        <a class="nav-link <?= $i == 0 ? "active" : "" ?>" id="<?= "id_" . $i . "_tab" ?>"
                           data-toggle="pill" href="#v-<?= $i ?>" role="tab"
                           aria-selected="<?= $i == 0 ? "true" : "false" ?>">
                            <img src="<?= $image ?>">
                        </a>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <?php $i = 0; ?>
                    <?php foreach ($product->getImages('original') as $image) : ?>
                        <div class="tab-pane fade  <?= $i == 0 ? "show active" : "" ?>" id="v-<?= $i ?>" role="tabpanel"
                             aria-labelledby="<?= "id_" . $i . "_tab" ?>">
                            <img src="<?= $image ?>">
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="content">
                <ul class="product-page__colors d-none">
                    <li class="active" style="background-color: black; outline-color: black;">
                        <a href="#"></a>
                    </li>
                    <li style="background-color: blue; outline-color: blue;">
                        <a href="#"></a>
                    </li>
                    <li style="background-color: pink; outline-color: pink;">
                        <a href="#"></a>
                    </li>
                </ul>
                <span class="inStok">В наличие</span>
                <h1 class="title"><?= $product['name'] ?></h1>
                <ul class="content-prices">
                    <li>
                        <span class="text"><?= Yii::t('app', 'price') ?></span>
                        <span class="price "><span><?= $product['price'] ?></span>  <?= Yii::t('app', 'sum') ?></span>
                    </li>
                    <li>
                        <span class="text"><?= Yii::t('app', 'loan_price') ?></span>
                        <span class="price  "><span><?= $product['loan_price'] ?></span> <?= Yii::t('app', 'sum') ?></span>
                        <!--                        <span class="price text line-through"><span>55454545</span> сум</span>-->
                    </li>
                    <li>
                        <span class="text">Экономия</span>
                        <span class="price "><span>1 157 118</span>  <?= Yii::t('app', 'sum') ?></span>
                    </li>
                </ul>

                <div class="btns">
                    <a herf="#" class="btn btn-yellow" data-toggle="modal" data-target="#product-vKarzinu">Быстрая
                        покупка</a>
                    <a herf="#" class="btn btn-yellow" data-toggle="modal" data-target="#product-rassrochka">В
                        рассрочку</a>
                    <a href="#" class="btn btn-balance"><i class="fa fa-balance-scale"></i></a>
                    <a href="#" id="singleAddProduct" class="btn btn-balance"><i
                                class="fa fa-cart-arrow-down"></i></a>
                </div>

                <div class="links">
                    <a href="#" class="link-grey">Бесплатная доставка и поднятие до этажа</a>
                    <a href="#" class="link-grey">30 дней на возврат</a>
                    <a href="#" class="link-grey">Гарантия</a>
                    <a href="#" class="link-grey">Бонусы для обладателей карт лояльности.</a>
                </div>

                <div class="cards">
                    <span class="cards-title">Если вы обладатель карты постоянного покупателя, выберите тип
                        карты для более низкой цены</span>
                    <select class="select-box">
                        <option>Нет карты</option>
                        <option>Member</option>
                        <option>Classic</option>
                        <option>Silver</option>
                        <option>Gold</option>
                        <option>Platium</option>
                    </select>
                    <a href="#" class="link-green">Что такое бонусная карта?</a>
                </div>
                <br>
                <a href="<?= \yii\helpers\Url::toRoute('site/legal-entity-order') ?>" class="link-yellow">Купить по
                    безналичному расчету для юрлиц</a>
            </div>
        </div>
        <!-- End of .product-page__info -->
    </div>
</div>
<!-- End of .main-block -->

<!-- ========= Start of btn modals ========= -->

<!-- Modal .btn #product-rassrochka -->
<div class="modal fade" id="product-rassrochka" data-backdrop="static" data-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg p-2">
        <?php ActiveForm::begin([
            'action' => '/loan/request',
            'options' => ['class' => 'modal-content'],
        ]) ?>
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Купить в рассрочку</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
            <div class="summ">
                <span class="text">Полная сумма рассрочки:</span>
                <span class="summ-price" id="rSum"><span>0</span> сум</span>
            </div>
            <button type="submit" class="btn btn-yellow-3">Оформить рассрочку</button>
            <button type="button" class="btn btn-white-2" data-dismiss="modal">Сохранить и продолжить покупку
            </button>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>


<!-- Modal .btn #product-vKarzinu -->
<div class="modal fade" id="product-vKarzinu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg p-2" role="document">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Быстрая покупка</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="product-wrapper">
                    <li class="product-item" id="product_id" data-id="<?= $product->id ?>">
                        <div class="img">
                            <img src="<?= $product->getImages()[0] ?>">
                        </div>
                        <h1 class="name" id="productName"><?= $product->name ?></h1>
                        <div class="count-product">
                            <span class="control minus">-</span>
                            <span class="value" id="product_qty">1</span>
                            <span class="control plus">+</span>
                        </div>
                        <span class="price"><span
                                    id="totalPrice"><?= $product->sale_price ? $product->sale_price : $product->price ?></span> <?= Yii::t('app', 'sum') ?></span>
                    </li>
                </ul>

                <div class="">
                    <div class="form-group col-md-12 col-12">
                        <input id="name" type="text" class="form-control" placeholder="<?= Yii::t('app', 'name') ?>">
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <input id="phone" type="tel" class="registration-phone form-control"
                               placeholder="<?= Yii::t('app', 'phone') ?>">
                    </div>
                    <div id="inputCode" class="form-group col-md-4 col-12" hidden>
                        <input id="code" type="text" class="form-control"
                               placeholder="<?= Yii::t('app', 'verfy_code') ?>">
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <a href="#" id="get_fast_order_code"><?= Yii::t('app', 'getCode') ?></a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="fastOrder" type="button"
                        class="btn btn-yellow-3"><?= Yii::t('app', 'oformit_zakaz') ?></button>
            </div>
        </form>
    </div>
</div>

<!-- ========= End of btn modals ========= -->
<!-- Start of .main-block-2 -->
<div class="main-block-2 product-page__description">
    <div class="auto-container container_right-sidebar">
        <div class="article">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                       aria-controls="home" aria-selected="true">Описание товара</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="false">Спецификации</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <div class="description tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <?= $product['description'] ?>
                </div>
                <div class="specification tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="specification-item">
                        <!--                        <h1 class="title">Обшая</h1>-->
                        <ul class="list">

                            <?php foreach ($product->productAttributes as $attribute): ?>
                                <li>
                                    <span><?= $attribute['title'] ?></span>
                                    <span><?= $attribute['text'] ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="sidebar">
            <div class="sidebar-inner sticky-top">
                <div class="ad">
                    <img src="/images/jpg/ad.jpg" width="100%" height="100%">
                </div>
                <div class="news">
                    <a href="#" class="news-item">
                        <div class="content">
                            <span class="date">28 май 2016</span>
                            <h1 class="title">Оплачивайте пакупки через U-PAY</h1>
                            <span class="category">Все новости</span>
                        </div>
                        <img src="/images/jpg/news.jpg">
                    </a>
                    <a href="#" class="news-item">
                        <div class="content">
                            <span class="date">28 май 2016</span>
                            <h1 class="title">Оплачивайте пакупки через U-PAY</h1>
                            <span class="category">Все новости</span>
                        </div>
                        <img src="/images/jpg/news2.jpg">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="auto-container">
        <div class="carousel">
            <h1 class="title">Сопутствующие товары</h1>
            <div class="carousel-cards owl-carousel owl-theme">
                <div class="products-cards__item">
                    <a href="#" class="img">
                        <img src="/images/jpg/deals.jpg">
                    </a>
                    <div class="content">
                        <span class="category">Аксессуары</span>
                        <a href="#" class="name">ATX Aerolcool V3X <br>(красный)</a>
                        <span class="price"><span>130 000</span>сум</span>
                        <span class="discount"><span>200 000</span>сум</span>
                        <span class="description">В месяц по 90 000 сум<br>Предоплата 10%</span>
                        <div class="btns">
                            <span class="btn btn-yellow-2"><i class="fa fa-cart-arrow-down add-to-cart"></i></span>
                            <a href="#" class="btn btn-balance"><i class="fa fa-balance-scale"></i></a>
                        </div>
                    </div>
                </div>
                <div class="products-cards__item">
                    <a href="#" class="img">
                        <img src="/images/jpg/deals2.jpg">
                    </a>
                    <div class="content">
                        <span class="category">Аксессуары</span>
                        <a href="#" class="name">ATX Aerolcool V3X <br>(красный)</a>
                        <span class="price"><span>260 000</span>сум</span>
                        <span class="discount"><span>200 000</span>сум</span>
                        <span class="description">В месяц по 90 000 сум<br>Предоплата 10%</span>
                        <div class="btns">
                            <span class="btn btn-yellow-2"><i class="fa fa-cart-arrow-down add-to-cart"></i></span>
                            <a href="#" class="btn btn-balance"><i class="fa fa-balance-scale"></i></a>
                        </div>
                    </div>
                </div>
                <div class="products-cards__item">
                    <a href="#" class="img">
                        <span class="discount">-10%</span>
                        <img src="/images/jpg/deals3.jpg">
                    </a>
                    <div class="content">
                        <span class="category">Аксессуары</span>
                        <a href="#" class="name">ATX Aerolcool V3X <br>(красный)</a>
                        <span class="price"><span>600 000</span>сум</span>
                        <span class="discount"><span>800 000</span>сум</span>
                        <span class="description">В месяц по 90 000 сум<br>Предоплата 10%</span>
                        <div class="btns">
                            <span class="btn btn-yellow-2"><i class="fa fa-cart-arrow-down add-to-cart"></i></span>
                            <a href="#" class="btn btn-balance"><i class="fa fa-balance-scale"></i></a>
                        </div>
                    </div>
                </div>
                <div class="products-cards__item">
                    <a href="#" class="img">
                        <span class="discount">-30%</span>
                        <img src="/images/jpg/deals4.jpg">
                    </a>
                    <div class="content">
                        <span class="category">Аксессуары</span>
                        <a href="#" class="name">ATX Aerolcool V3X <br>(красный)</a>
                        <span class="price"><span>1 220 000</span>сум</span>
                        <span class="discount"><span>1 500 000</span>сум</span>
                        <span class="description">В месяц по 90 000 сум<br>Предоплата 10%</span>
                        <div class="btns">
                            <span class="btn btn-yellow-2"><i class="fa fa-cart-arrow-down add-to-cart"></i></span>
                            <a href="#" class="btn btn-balance"><i class="fa fa-balance-scale"></i></a>
                        </div>
                    </div>
                </div>
                <div class="products-cards__item">
                    <a href="#" class="img">
                        <img src="/images/jpg/deals5.jpg">
                    </a>
                    <div class="content">
                        <span class="category">Аксессуары</span>
                        <a href="#" class="name">ATX Aerolcool V3X <br>(красный)</a>
                        <span class="price"><span>900 000</span>сум</span>
                        <span class="discount"><span>1 200 000</span>сум</span>
                        <span class="description">В месяц по 90 000 сум<br>Предоплата 10%</span>
                        <div class="btns">
                            <span class="btn btn-yellow-2"><i class="fa fa-cart-arrow-down add-to-cart"></i></span>
                            <a href="#" class="btn btn-balance"><i class="fa fa-balance-scale"></i></a>
                        </div>
                    </div>
                </div>
                <div class="products-cards__item">
                    <a href="#" class="img">
                        <span class="discount">-35%</span>
                        <img src="/images/jpg/deals6.jpg">
                    </a>
                    <div class="content">
                        <span class="category">Аксессуары</span>
                        <a href="#" class="name">ATX Aerolcool V3X <br>(красный)</a>
                        <span class="price"><span>1 300 000</span>сум</span>
                        <span class="discount"><span>2 000 000</span>сум</span>
                        <span class="description">В месяц по 90 000 сум<br>Предоплата 10%</span>
                        <div class="btns">
                            <span class="btn btn-yellow-2"><i class="fa fa-cart-arrow-down add-to-cart"></i></span>
                            <a href="#" class="btn btn-balance"><i class="fa fa-balance-scale"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End of .main-block-2 -->
