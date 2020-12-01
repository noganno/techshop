<?php


function getProductHTML($product)
{
    $narx = $product['price'];
    if ($product['sale_price']) {
        $narx = $product['sale_price'];
    }
    if ($product['new']) {
        return '<div class="products-cards__item bestseller_new_recommended" data-id="' . $product['id'] . '">
                <span class="product_new">Novaya</span>
                <a href="' . \yii\helpers\Url::toRoute(['site/product', 'id' => $product['id']]) . '" class="img">
                    <img src="' . $product->getImages()[0] . '">
                </a>
                <div class="proporties">
                    <span class="category">' . $product['categories'][0]['name'] . '</span>
                    <a href="' . \yii\helpers\Url::toRoute(['site/product', 'id' => $product['id']]) . '" class="name">' . $product['name'] . '</a>
                    <ul class="proporties-list">
                        <li class="proporties-item">Диоганаль (дюйм): <span>4</span></li>
                        <li class="proporties-item">Разрешение (пикс): <span>800x480</span></li>
                        <li class="proporties-item">Фотокамера (мп): <span>2</span></li>
                        <li class="proporties-item">Процессор: <span>MediaTek MT6572</span></li>
                    </ul>
                </div>
                <div class="content">
                    <span class="category">' . $product['categories'][0]['name'] . '</span>
                    <a href="' . \yii\helpers\Url::toRoute(['site/product', 'id' => $product['id']]) . '" class="name">' . $product['name'] . '</a>
                    <h3 class="price"><span>' . $narx . '</span> сум</h3>
                    <p class="description">В месяц по 120 000 сум Предоплата 10% </p>
                    <div class="btns">
                                    <span class="btn btn-yellow add-to-cart"><i class="fa fa-cart-arrow-down"></i>В
                                        корзину</span>
                        <a href="#" class="btn btn-balance"><i class="fa fa-balance-scale"></i></a>
                    </div>
                </div>
            </div>';
    } else if ($product['recommend']) {
        return '<div class="products-cards__item bestseller_new_recommended" data-id="' . $product['id'] . '">
                <span class="product_recommended">Recomed</span>
                <a href="' . \yii\helpers\Url::toRoute(['site/product', 'id' => $product['id']]) . '" class="img">
                    <img src="' . $product->getImages()[0] . '">
                </a>
                <div class="proporties">
                    <span class="category">' . $product['categories'][0]['name'] . '</span>
                    <a href="' . \yii\helpers\Url::toRoute(['site/product', 'id' => $product['id']]) . '" class="name">' . $product['name'] . '</a>
                    <ul class="proporties-list">
                        <li class="proporties-item">Диоганаль (дюйм): <span>4</span></li>
                        <li class="proporties-item">Разрешение (пикс): <span>800x480</span></li>
                        <li class="proporties-item">Фотокамера (мп): <span>2</span></li>
                        <li class="proporties-item">Процессор: <span>MediaTek MT6572</span></li>
                    </ul>
                </div>
                <div class="content">
                    <span class="category">' . $product['categories'][0]['name'] . '</span>
                    <a href="' . \yii\helpers\Url::toRoute(['site/product', 'id' => $product['id']]) . '" class="name">' . $product['name'] . '</a>
                    <h3 class="price"><span>' . $narx . '</span> сум</h3>
                    <p class="description">В месяц по 120 000 сум Предоплата 10% </p>
                    <div class="btns">
                                    <span class="btn btn-yellow add-to-cart"><i class="fa fa-cart-arrow-down"></i>В
                                        корзину</span>
                        <a href="#" class="btn btn-balance"><i class="fa fa-balance-scale"></i></a>
                    </div>
                </div>
            </div>';
    } else if ($product['xit']) {
        return '<div class="products-cards__item bestseller_new_recommended" data-id="' . $product['id'] . '">
                <span class="product_bestseller">Хит продаж</span>
                <a href="' . \yii\helpers\Url::toRoute(['site/product', 'id' => $product['id']]) . '" class="img">
                    <img src="' . $product->getImages()[0] . '">
                </a>
                <div class="proporties">
                    <span class="category">' . $product['categories'][0]['name'] . '</span>
                    <a href="' . \yii\helpers\Url::toRoute(['site/product', 'id' => $product['id']]) . '" class="name">' . $product['name'] . '</a>
                    <ul class="proporties-list">
                        <li class="proporties-item">Диоганаль (дюйм): <span>4</span></li>
                        <li class="proporties-item">Разрешение (пикс): <span>800x480</span></li>
                        <li class="proporties-item">Фотокамера (мп): <span>2</span></li>
                        <li class="proporties-item">Процессор: <span>MediaTek MT6572</span></li>
                    </ul>
                </div>
                <div class="content">
                    <span class="category">' . $product['categories'][0]['name'] . '</span>
                    <a href="' . \yii\helpers\Url::toRoute(['site/product', 'id' => $product['id']]) . '" class="name">' . $product['name'] . '</a>
                    <h3 class="price"><span>' . $narx . '</span> сум</h3>
                    <p class="description">В месяц по 120 000 сум Предоплата 10% </p>
                    <div class="btns">
                                    <span class="btn btn-yellow add-to-cart"><i class="fa fa-cart-arrow-down"></i>В
                                        корзину</span>
                        <a href="#" class="btn btn-balance"><i class="fa fa-balance-scale"></i></a>
                    </div>
                </div>
            </div>';
    } else {
        return '            <div class="products-cards__item" data-id="' . $product['id'] . '">
                <a href="' . \yii\helpers\Url::toRoute(['site/product', 'id' => $product['id']]) . '" class="img">
                    <img src=' . $product->getImages()[0] . '>
                </a>
                <div class="proporties">
                    <span class="category">' . $product['categories'][0]['name'] . '</span>
                    <a href="' . \yii\helpers\Url::toRoute(['site/product', 'id' => $product['id']]) . '" class="name">' . $product['name'] . '</a>
                    <ul class="proporties-list">
                        <li class="proporties-item">Диоганаль (дюйм): <span>4</span></li>
                        <li class="proporties-item">Разрешение (пикс): <span>800x480</span></li>
                        <li class="proporties-item">Фотокамера (мп): <span>2</span></li>
                        <li class="proporties-item">Процессор: <span>MediaTek MT6572</span></li>
                    </ul>
                </div>
                <div class="content">
                    <span class="category">' . $product['categories'][0]['name'] . '</span>
                    <a href="' . \yii\helpers\Url::toRoute(['site/product', 'id' => $product['id']]) . '" class="name">' . $product['name'] . '</a>
                    <h3 class="price"><span>' . $narx . '</span> сум</h3>
                    <p class="description">В месяц по 120 000 сум Предоплата 10% </p>
                    <div class="btns">
                                    <span class="btn btn-yellow add-to-cart"><i class="fa fa-cart-arrow-down"></i>В
                                        корзину</span>
                        <a href="#" class="btn btn-balance"><i class="fa fa-balance-scale"></i></a>
                    </div>
                </div>
            </div>';
    }

}

?>
<!-- Start of .main-block -->
<div class="main-block filter-product">
    <div class="auto-container container_left-sidebar-2">
        <div class="sidebar">
            <form class="inner-sidebar">
                <div class="sidebar-accardion">
                    <div class="sidebar-accardion__item">
                        <h3 class="title"><i class="fa fa-angle-down"></i> Наши
                            предложения.</h3>
                        <div class="content">
                            <ul class="">
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Новинки
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Советуем
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Хит продаж
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-accardion__item">
                        <h3 class="title"><i class="fa fa-angle-down"></i> Производитель.</h3>
                        <div class="content">
                            <ul>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Samsung
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        LG
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Xiomai
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Braoun
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        indesit
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Artel
                                    </label>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-accardion__item">
                        <h3 class="title"><i class="fa fa-angle-down"></i> Операционная система.</h3>
                        <div class="content">
                            <ul>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        iOS
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Windows Phone
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Windows 10 Mobile
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Android 4.4 KitKat
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Cyanogen
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        MIUI
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-accardion__item">
                        <h3 class="title"><i class="fa fa-angle-down"></i> Поддержка 2-х SIM-карт.</h3>
                        <div class="content">
                            <ul>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        1
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        2
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-accardion__item">
                        <h3 class="title"><i class="fa fa-angle-down"></i> Тип SIM-карты.</h3>
                    </div>

                    <div class="sidebar-accardion__item">
                        <h3 class="title"><i class="fa fa-angle-down"></i> Основная камера (мпикс).</h3>
                        <div class="content">
                            <ul>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        2
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        3
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        5
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        8
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        12
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        20
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        25
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Двойная
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-accardion__item">
                        <h3 class="title"><i class="fa fa-angle-down"></i> Основная камера (мпикс).</h3>
                        <div class="content">
                            <ul>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        480x320
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        800x480
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        854x480
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        864x480
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        960x540
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        1136x640
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        1280x720
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        1334x750
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-accardion__item">
                        <h3 class="title"><i class="fa fa-angle-down"></i> Диагональ дисплея (дюйм).</h3>
                        <div class="content">
                            <ul>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        5
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        5.2
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        5.5
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-accardion__item">
                        <h3 class="title"><i class="fa fa-angle-down"></i> Цвет</h3>
                        <div class="content">
                            <ul>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Синий
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Красные
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Серебристый
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Белый
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Бежевый
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Оражевый
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input class="" type="checkbox">
                                        Розовый
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-accardion__item">
                        <h3 class="title"><i class="fa fa-angle-down"></i> Емкость аккумулятора (мАч)</h3>
                        <div class="content">
                            <div class="handle-slider" id="handle-slider">
                                <div id="slider-range">
                                    <span id="inner-value-min" hidden>0</span>
                                    <span id="inner-value-max" hidden>50000</span>
                                </div>
                                <p class="handle-slider-values">
                                    <input type="text" id="handle-slider-val-1" readonly>
                                    <input type="text" id="handle-slider-val-2" readonly>
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="filtering">
                    <span class="resualt-filtering">Подобрано <span>222</span> товаров</span>
                    <button class="btn btn-yellow-3" type="submit">Показать</button>
                    <button class="btn btn-reset" type="reset"><i class="fa fa-remove"></i> Сбросить фильтр</button>
                </div>
            </form>
        </div>
        <div class="article">
            <div class="product-wrapper-top">
                <div class="wrapper-block">
                    <div class="inner-block">
                        <span class="sort">Сортировать: </span>
                        <p class="btn-links">
                            <a href="#"><i class="fa fa-money"></i> По цене</a>
                            <a href="#"><i class="fa fa-font"></i> По алфавиту</a>
                            <a href="#"><i class="fa fa-star-o"></i> По популярности</a>
                        </p>
                    </div>
                    <p class="inner-block-min" id="product-group-sort-icon">
                        <span>Вид:</span>
                        <i class="fa fa-th-list"></i>
                        <i class="fa fa-th-large active"></i>
                    </p>
                </div>
            </div>
            <!-- agar fa-th-large.active bolsa product-wrapperga th-large classi qo'shiladi.  -->
            <!-- agar fa-th-list.active bolsa product-wrapperga th-list classi qo'shiladi.  -->
            <div class="product-wrapper-bottom  th-large" id="product-group-sort-wrapper">

                <?php foreach ($products as $product): ?>
                    <?= getProductHTML($product) ?>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <?= \frontend\components\TexnomartLinkPager::widget([
        'pagination' => $pages,
    ]);?>
</div>