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
    <!-- Start of .breadcrumb-outer -->
    <div class="breadcrumb-outer">
        <div class="auto-container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Корзина</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End of .breadcrumb-outer -->
    <div class="auto-container container_left-sidebar-2">
        <div class="sidebar">
            <form class="inner-sidebar">
                <div class="sidebar-accardion">
                    <div class="sidebar-accardion__item">
                        <h3 class="title"><i class="fa fa-angle-down"></i> Все товары
                            XIAOMI.</h3>
                        <div class="content">
                            <ul>
                                <li>
                                    <a class="active" href="#">Смартфоны</a>
                                </li>
                                <li>
                                    <a href="#">Планшеты и ноутбуки</a>
                                </li>
                                <li>
                                    <a href="#">Гаджеты и устройства</a>
                                </li>
                                <li>
                                    <a href="#">Наушники и колонки</a>
                                </li>
                                <li>
                                    <a href="#">Зарядные устройства</a>
                                </li>
                                <li>
                                    <a href="#">Аксессуары</a>
                                </li>
                            </ul>
                        </div>
                    </div>

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
            <div class="product-wrapper-bottom th-large" id="product-group-sort-wrapper">

                <?php foreach ($products as $product): ?>
                    <?= getProductHTML($product) ?>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <div class="auto-container">
        <nav class="outer-pagination py-2">
            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
            ]);?>
            <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1"><img src="./images/png/arrow-left.png">
                        <span>Предыдующая</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link active" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#"><span>Следующая</span><img
                                src="./images/png/arrow-right.png"></a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- End of .main-block -->