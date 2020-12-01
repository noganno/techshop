<?php
?>


<?php if ($this->beginCache("mobilebottom1", ['duration' => Yii::$app->params['pageCache']])): ?>


<div class="mobile-bottom">
    <ul class="mobile-bottom-menu">

        <form class="search-box" action="<?= url_to(['product/search']) ?>">
            <input required name="key" type="search" class="search" placeholder="<?= Yii::t('app', 'Search products through the site') ?>">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>

        <li class="mobile-bottom-menu__item">
                <span class="mobile-bottom-menu__search">
                    <i class="fa fa-search"></i>
                    <span class="text">Поиск</span>
                </span>
        </li>
        <li class="mobile-bottom-menu__item">
            <a href="<?= url_to(['site/balance']) ?>" class="mobile-bottom-menu__link <?= $this->route == 'balance/index' ? 'active' : '' ?>">
                <i class="fa fa-balance-scale"></i>
                <span class="text"><?= t('Balance') ?></span>
            </a>
        </li>
        <li class="mobile-bottom-menu__item">
                <span class="mobile-bottom-menu__link basket cart" data-toggle="modal" data-target="#product-basket">
                    <i class="fa fa-cart-arrow-down basket-icon">
                        <span class="count cart-items-count"><?php echo $this->renderDynamic('return Yii::$app->cart->countItems;'); ?></span>
                    </i>
                    <span class="text"><?= t('Cartm') ?></span>
                </span>
        </li>
        <li class="mobile-bottom-menu__item">
            <a href="<?= url_to(['profile/personal-data']) ?>" class="mobile-bottom-menu__link <?= $this->route == 'profile/personal-data' ? 'active' : '' ?>">
                <i class="fa fa-user"></i>
                <span class="text"><?= t('Cabinet') ?></span>
            </a>
        </li>
    </ul>
</div>

    <?php $this->endCache(); ?>
<?php endif ?>