<?php
?>


<div class="sidebar">
    <div class="inner-sidebar">
        <ul class="sidebar-links">
<h5 class="text-danger">На сайте ведутся технические работы</h5>
            <li class="sidebar-item">
                <a class="sidebar-link <?= $this->route == 'profile/personal-data' ? 'active' : '' ?>"
                   href="<?= url_to(['profile/personal-data']) ?>">
                    <i class="fa fa-user"></i>
                    <span class="text">
                        <span><?= t('Personal data') ?></span>
                       <?= t('Change password, name, e-mail (email address) and phone number') ?>
                    </span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link <?= $this->route == 'profile/moi-pokupki' ? 'active' : '' ?>"
                   href="<?= url_to(['profile/moi-pokupki']) ?>">
                    <i class="fa fa-cart-arrow-down"></i>
                    <span class="text">
                        <span><?= t('Moi Pokupki') ?></span>
                       <?= t('desc moi pokupki') ?>
                    </span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link <?= $this->route == 'profile/credit-history' ? 'active' : '' ?>"
                   href="<?= url_to(['profile/credit-history']) ?>">
                    <i class="fa fa-list-alt"></i>
                    <span class="text"><span><?= t('Moi dogovori') ?></span>Информации по договорам, оплатам и бонусам</span>
                </a>
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link <?= $this->route == 'profile/order-history' ? 'active' : '' ?>"
                   href="<?= url_to(['profile/order-history']) ?>">
                    <i class="fa fa-first-order"></i>
                    <span class="text"><span><?= t('Order History') ?></span>Информации по договорам, оплатам и бонусам</span>
                </a>
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link" href="<?= \yii\helpers\Url::toRoute('site/logout') ?>">
                    <i class="fa fa-sign-out"></i>
                    <span class="text"><span>Выйти</span>Выход из аккаунта</span>
                </a>
            </li>
        </ul>
    </div>
</div>
