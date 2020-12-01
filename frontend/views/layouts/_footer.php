<?php

    use yii\helpers\Url;

?>

<div class="footer">
    <div class="footer-top"> 
        <div class="auto-container">
            <div class="footer-top__contact">
                <div class="tel item">
                    <div class="icon">
                        <img src="/images/icons/headphone.png">
                    </div>
                    <div class="text">
                        <p><?= Yii::t('app', 'savol_call') ?></p>
                        <a href="tel:+998712099944">+99871 209 99 44</a>
                    </div>
                </div>
                <div class="tel item" style="margin-top: 15px">
                    <div class="icon">
                        <img src="/images/icons/location.png">
                    </div>
                    <div class="text">
                        <p><?= Yii::t('app', 'Адрес и контакты всех') ?></p>
                        <a style="" href="<?= url_to(['site/sklad-map']) ?>"><?= Yii::t('app', 'our_magazines') ?></a>
                    </div>
                </div>
            </div>
            <div class="footer-top__main">
                <ul class="item">
                    <h1 class="title"><?= Yii::t('app', 'company') ?></h1>
                    <li>
                        <a href="<?= Url::to(['site/page', 'id' => 'about']) ?>"><?= Yii::t('app', 'About us') ?></a>
                    </li>
<!--                    <li>-->
<!--                        <a href="--><?//= Url::to(['blog/all-news']) ?><!--">--><?//= Yii::t('app', 'News') ?><!--</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="--><?//= Url::to(['site/page', 'id' => 'partners']) ?><!--">--><?//= Yii::t('app', 'Partners') ?><!--</a>-->
<!--                    </li>-->
                  <!--  <li>
                        <a href="<?/*= url_to(['site/sklad-map']) */?>"><?/*= Yii::t('app', 'our_magazines') */?></a>
                    </li>-->
<!--                    <li>-->
<!--                        <a href="--><?//= Url::to(['site/page', 'id' => 'vacancies']) ?><!--">--><?//= Yii::t('app', 'Vacants') ?><!--</a>-->
<!--                    </li>-->
                </ul>
                <ul class="item">
                    <h1 class="title"><?= Yii::t('app', 'qarzga_olish') ?></h1>
                    <li>
                        <a href="<?= Url::to(['site/page', 'id' => 'how-to-purchase']) ?>"><?= Yii::t('app', 'kak_kupit') ?></a>
                    </li>
                   <!-- <li>
                        <a href="<?/*= Url::to(['site/page', 'id' => 'bonus-system']) */?>"><?/*= Yii::t('app', 'bonus_system') */?></a>
                    </li>-->
                    <li>
                        <a href="<?= url_to(['profile/personal-data']) ?>"><?= Yii::t('app', 'Personal cabinet') ?></a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['site/page', 'id' => 'free-delivery']) ?>"><?= Yii::t('app', 'usloviya_dostavki') ?></a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['site/page', 'id' => 'warranty']) ?>"><?= Yii::t('app', 'garantiya_na_tovari') ?></a>
                    </li>
                </ul>
                <ul class="item">
                    <h1 class="title"><?= Yii::t('app', 'Information') ?></h1>
                   <!-- <li>
                        <a href=""><?/*= Yii::t('app', 'Posts') */?></a>
                    </li>-->
<!--                    <li>-->
<!--                        <a href="--><?//= Url::to(['site/page', 'id' => 'information']) ?><!--">--><?//= Yii::t('app', 'Information') ?><!--</a>-->
<!--                    </li>-->
                    <li>
                        <a href="<?= Url::to(['site/page', 'id' => 'about-manufacturers']) ?>"><?= Yii::t('app', 'Manufacturers') ?></a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['blog/reviews']) ?>"><?= Yii::t('app', 'Reviews') ?></a>
                    </li>
                </ul>
            </div>
            <div class="footer-top__fb-widget">

<!--                <div class="fb-page" data-href="https://www.facebook.com/texnomart" data-tabs="timeline" data-width="" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/texnomart" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/texnomart">Texnomart</a></blockquote></div>-->
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="auto-container">
            <a href="index.html" class="footer-logo">
                <img style="opacity: 0.4" src="/images/logo.png">
            </a>
            <p class="text">
                <?= Yii::t('app', 'footer_gap') ?>
            </p>
            <div class="payment">
                <a href="#" class="payment-card" style="display:none !important">
                    <img src="/images/icons/card-visa.png" alt="">
                </a>
                <a href="#" class="payment-card">
                    <img src="/images/icons/card-uzcard.png" alt="">
                </a>
                <a href="#" class="payment-card">
                    <img src="/images/icons/card-upay.png" alt="">
                </a>
            </div>
        </div>
    </div>
</div>
