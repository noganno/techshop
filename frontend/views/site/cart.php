<?php


?>
<!-- Start of .main-block -->
<div class="main-block cart">

    <form class="auto-container">
        <div class="cart-table">
            <div class="responsive-table">
                <table>
                    <thead>
                    <tr>
                        <th class="title">Наименование товара</th>
                        <td class="title">Количество</td>
                        <td class="title">Цена</td>
                        <td class="title">Делате</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product): ?>
                        <?php $product = \common\models\Product::findOne($product['product_id']) ?>
                        <tr>
                            <th class="name-column">
                                <div>
                                    <div class="img">
                                        <img src="<?= $product->images[0] ?>">
                                    </div>
                                    <div class="content">
                                        <p class="category"><?= $product->categories[0]['name'] ?></p>
                                        <a href="<?= \yii\helpers\Url::to(['site/product', 'id' => $product->id]) ?>"
                                           class="name"><?= $product->name ?>></a>
                                    </div>
                                </div>
                            </th>
                            <td class="count-column">
                                <div class="count-product">
                                    <span class="control minus">-</span>
                                    <span class="value">1</span>
                                    <span class="control plus">+</span>
                                    <p class="addText">Добавить</p>
                                </div>
                            </td>
                            <td>
                                <div class="price-column">
                                    <p class="price">
                                        <span><?= $product->sale_price == null ? $product->price : $product->sale_price ?></span>
                                        сум</p>
                                    <p class="text">В месяц по 25 000 сум Предоплата 30% Цена в рассочку 2 690 000
                                        сум </p>
                                </div>
                            </td>
                            <td class="remove-column">
                                <span class="remove">&times;</span>
                            </td>
                        </tr>
                    <?php endforeach; ?>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="cart-cards">
            <p class="text">Выберите тип бонусной карты</p>
            <div class="radioBox">
                <label>
                    <input type="radio" name="card">
                    Нет карты
                </label>
                <label>
                    <input type="radio" name="card">
                    Member
                </label>
                <label>
                    <input type="radio" name="card">
                    Classic
                </label>
                <label>
                    <input type="radio" name="card">
                    Silver
                </label>
                <label>
                    <input type="radio" name="card">
                    Gold
                </label>
                <label>
                    <input type="radio" name="card">
                    Platinum
                </label>
            </div>

            <a href="#" class="link-green">Что такое бонусная карта?</a>
        </div>
        <div class="cart-total">
            <i class="fa fa-cart-arrow-down"></i>
            <p class="text">Итого: <span class="count-product">2</span> товара, предоплата <span class="total-products">500 000</span>
                сум</p>
            <button class="btn btn-yellow-3">Оформить заказ</button>
        </div>
    </form>
</div>