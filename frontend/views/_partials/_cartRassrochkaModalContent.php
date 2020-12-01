<?php

use yii\helpers\Url;

$cart = Yii::$app->cart;
$hasItems = $cart->hasItems;
$totalSum = 0;
$totalSumRassrochku = 0;
$products = $cart->products;


$this->registerJsFile('js/loan/common.js', [
    'depends' => 'frontend\assets\AppAsset'
]);

?>
<form class="modal-content" action="<?= Url::to(['shop/rassrochka']) ?>" method="post">
    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>"/>
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Купить в рассрочку</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <?php if (!empty($products)): ?>

        <div class="modal-body">
            <ul class="product-wrapper">

                <?php foreach ($products as $product): ?>

                    <?php
                    $count = isset($cart->items[$product->id]) ? $cart->items[$product->id] : 1;
                    $totalSum += $product->sale_price * $count;
                    $totalSumRassrochku += $product->loan_price * $count;
                    ?>

                    <li class="product-item">
                        <div class="remove">
                            <span class="icon remove-from-cart" data-product-id="<?= $product->id ?>">×</span>
                        </div>
                        <div class="img">
                            <img src="<?= $product->getImage('cart') ?>">
                        </div>
                        <div class="texts">
                            <span class="name">
                                <?= e($product->name) ?>
                            </span>
                            <!--                            <span>-->
                            <!--                                --><? //= $count  ?>
                            <!--                            </span>-->
                            <!--  <span class="price">
                                (x<? /*= $count */ ?>)

                                  <?php
                            /*                                  $sum = $product->loan_price * $count;
                                                              $totalSum += $sum;
                                                              */ ?>

                            <? /*= Yii::$app->formatter->asSum($sum) */ ?>
                            </span>-->
                        </div>
                        <div class="count-product">
                            <span class="control minus minus-from-cart">-</span>
                            <span class="value" data-product-id="<?= $product->id ?>"><?= $count ?></span>
                            <span class="control plus plus-to-cart">+</span>
                        </div>
                    </li>

                <?php endforeach ?>

            </ul>
            <div class="table-responsive table-responsive-lg">
                <hr>
                <div class="forma">
                    <label class="radio-inline">
                        <input data-type="trendy" required type="radio" name="loan_type" id="inlineRadio1" value="1">
                        <img
                                style="width: 80px; display: inline-block" src="/files/global/rassrochka/texnomart.png">
                    </label>
                    <label class="radio-inline">
                        <input data-type="unired" required type="radio" name="loan_type" id="inlineRadio2" value="2">
                        <img
                                style="width: 80px; display: inline-block" src="/files/global/rassrochka/unired.png">
                    </label>
                    <label class="radio-inline">
                        <input data-type="zmarket" required type="radio" name="loan_type" id="inlineRadio3" value="3">
                        ZMarket
                    </label>
                </div>

                <style>
                    .forma {
                        display: flex;
                        justify-content: space-around;
                    }

                    .forma input img {
                        width: 10px;
                    }
                </style>

            </div>

            <div class="container">

                <div class="row mt-4">
                    <hr>
                    <div class="loan-table table-responsive d-none table-unired">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="summ">Сумма полной оплаты</label>
                                <input value="<?= $totalSum ?>" disabled type="text" class="form-control summ"
                                       name="summ"
                                       aria-describedby="emailHelp"
                                       placeholder="Введите сумму полной оплаты товара"/>
                                <small class="form-text text-muted">Введите сумму полной оплаты товара</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="summ">Баланс карты Unired</label>
                                <input type="text" class="form-control summ summ_r" name="summ_r"
                                       aria-describedby="emailHelp"
                                       placeholder="Введите лимит карты Unired"/>
                                <small id="emailHelp" class="form-text text-muted">Введите лимит карты Unired</small>
                            </div>
                        </div>
                        <h2 class="headings">
                            Тарифы <span class="unlogo">UNIRED</span>
                        </h2>
                        <table class="table table-bordered table-hover">
                            <thead class="unired-static">
                            <tr class="table-main">
                                <th>Размер заработной платы, выдаваемой на пластиковую карту</th>
                                <th>Первоначальный лимит</th>
                                <th>Максимальный лимит</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1&nbsp;200&nbsp;000</td>
                                <td>3&nbsp;000&nbsp;000</td>
                                <td>9&nbsp;000&nbsp;000</td>
                            </tr>
                            <tr>
                                <td>1&nbsp;500&nbsp;000</td>
                                <td>4&nbsp;500&nbsp;000</td>
                                <td>10&nbsp;500&nbsp;000</td>
                            </tr>
                            <tr>
                                <td>2&nbsp;000&nbsp;000</td>
                                <td>6&nbsp;000&nbsp;000</td>
                                <td>12&nbsp;000&nbsp;000</td>
                            </tr>
                            <tr>
                                <td>3&nbsp;000&nbsp;000</td>
                                <td>9&nbsp;000&nbsp;000</td>
                                <td>15&nbsp;000&nbsp;000</td>
                            </tr>
                            <tr>
                                <td>4&nbsp;000&nbsp;000</td>
                                <td>12&nbsp;000&nbsp;000</td>
                                <td>18&nbsp;000&nbsp;000</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="totalSumm"></div>


                    <div class="loan-table table-responsive d-none table-zmarket">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="summ">Сумма полной оплаты</label>
                                <input value="<?= $totalSum ?>" disabled type="text" class="form-control summ"
                                       name="summ"
                                       aria-describedby="emailHelp"
                                       placeholder="Введите сумму полной оплаты товара"/>
                                <small class="form-text text-muted">Введите сумму полной оплаты товара</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="summ">Лимит</label>
                                <input type="text" class="form-control summ summ_r" name="summ_r"
                                       aria-describedby="emailHelp"
                                       placeholder="Введите лимит"/>
                                <small id="emailHelp" class="form-text text-muted">Введите лимит</small>
                            </div>
                        </div>

                        <h2 class="headings">
                            Тарифы <span class="unlogo">Z Market</span>
                        </h2>
                        <table class="table table-bordered table-hover">
                            <thead class="zmarket-static">
                            <tr class="table-main">
                                <th>Размер заработной платы, выдаваемой на пластиковую карту</th>
                                <th>Максимальный лимит</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>800&nbsp;000</td>
                                <td>1&nbsp;500&nbsp;000</td>
                            </tr>
                            <tr>
                                <td>1&nbsp;000&nbsp;000</td>
                                <td>3&nbsp;000&nbsp;000</td>
                            </tr>
                            <tr>
                                <td>2&nbsp;000&nbsp;000</td>
                                <td>5&nbsp;000&nbsp;000</td>
                            </tr>
                            <tr>
                                <td>3&nbsp;000&nbsp;000</td>
                                <td>8&nbsp;000&nbsp;000</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="totalSummZmarket"></div>


                    <div class="loan-table table-responsive d-none table-trendy">
                        <h3>Trendy Trade</h3>
                        <hr>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="summ">Сумма рассрочки</label>
                                <input disabled type="text" class="form-control summ" name="summTrendy"
                                       aria-describedby="emailHelp"
                                       value="<?= $totalSumRassrochku ?>"
                                       placeholder="Введите сумму рассрочки"/>
                                <small class="form-text text-muted">Введите сумму рассрочки</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="summ">Задолженность</label>
                                <input type="text" class="form-control summ" name="summDebt"
                                       aria-describedby="emailHelp"
                                       placeholder="Введите сумму задолженности"/>
                                <small class="form-text text-muted">Введите сумму задолженности</small>
                            </div>
                        </div>


                        <h2 class="headings">
                            Бонусные карты <span class="unlogo">Trendy Trade</span>
                        </h2>
                        <table class="table table-bordered table-hover">
                            <thead class="trendy-static">
                            <tr class="table-main">
                                <th>Типы бонусных карт</th>
                                <th>Сумма апгрейда</th>
                                <th>Максимальный лимит</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Start</td>
                                <td>&nbsp;0&nbsp;</td>
                                <td>7&nbsp;000&nbsp;000</td>
                            </tr>
                            <tr>
                                <td>Member</td>
                                <td>1&nbsp;300&nbsp;000</td>
                                <td>10&nbsp;000&nbsp;000</td>
                            </tr>
                            <tr>
                                <td>Classic</td>
                                <td>3&nbsp;500&nbsp;000</td>
                                <td>15&nbsp;000&nbsp;000</td>
                            </tr>
                            <tr>
                                <td>Silver</td>
                                <td>10&nbsp;000&nbsp;000</td>
                                <td>22&nbsp;000&nbsp;000</td>
                            </tr>
                            <tr>
                                <td>Gold</td>
                                <td>30&nbsp;000&nbsp;000</td>
                                <td>35&nbsp;000&nbsp;000</td>
                            </tr>
                            <tr>
                                <td>Platinum</td>
                                <td>50&nbsp;000&nbsp;000</td>
                                <td>50&nbsp;000&nbsp;000</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="totalSummTrendy"></div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <!--                <div class="summ">-->
            <!--                    <span class="text">--><? //= t('Полная сумма рассрочки') ?><!--:</span>-->
            <!--                    <span class="summ-price">-->
            <!--                        --><? //= Yii::$app->formatter->asSum($totalSum) ?>
            <!--                    </span>-->
            <!--                </div>-->
            <button type="submit" class="btn btn-yellow-3"><?= t('Оформить рассрочку') ?></button>
            <!--<button <? /*= Yii::$app->user->isGuest ? 'data-toggle="modal" data-target="#login-modal"' : "" */ ?>
                    type="<? /*= Yii::$app->user->isGuest ? 'button' : 'submit' */ ?>"
                    class="btn btn-yellow-3"><? /*= t('Оформить рассрочку') */ ?></button>
            -->

            <button type="button" class="btn btn-white-2"
                    data-dismiss="modal"><?= t('Продолжить покупку') ?></button>
        </div>

    <?php else: ?>
        <?= \frontend\components\ModalBodyNoProductsWidget::widget() ?>
    <?php endif ?>
</form>
