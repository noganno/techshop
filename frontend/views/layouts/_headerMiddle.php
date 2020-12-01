<?php

use frontend\models\Category;
use soft\widget\LanguageSwitcher;
use yii\helpers\Url;

?>


<div class="header-middle  hs-menubar">
    <div class="auto-container">
        <div class="menu-trigger"><i class="zmdi zmdi-menu"></i></div>
        <a href="<?= Url::to(['site/index']) ?>" class="logo">
            <img src="/images/logo.png">
        </a>
        <form class="search-box" action="<?= url_to(['product/search']) ?>">

            <input type="text" required class="search-box__input" name="key"
                   placeholder="<?= Yii::t('app', 'Search products through the site') ?>">
            <div class="search-box__select2">
                <input type="hidden" hidden name="category" value="all" id="category-id">
                <div class="select">
                    <span><?= t("All categories") ?></span>
                    <i class="fa fa-chevron-down"></i>
                </div>
                <?php if ($this->beginCache("headerMiddleCategories", ['duration' => Yii::$app->params['pageCache']])): ?>
                    <ul class="search-box__select2-menu">
                        <? foreach (Category::mainCategories(Yii::$app->language) as $category) { ?>
                            <li id="<?= $category->id ?>"><?= $category->name ?></li>
                        <?php } ?>
                    </ul>
                    <?php $this->endCache(); ?>
                <?php endif ?>

            </div>
            <button class="search-box__btn"><i class="fa fa-search"></i></button>
        </form>

        <?
        if (Yii::$app->user->isGuest) {
            ?>
            <span class="register">
              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                   x="0px" y="0px" width="25px" height="25px"
                   viewBox="0 0 24 29" enable-background="new 0 0 24 29" xml:space="preserve">
                                      <g transform="translate(0,-952.36218)">
                                          <path fill="#777777" d="M12,952.412c-3.499,0-6.357,2.859-6.357,6.359c0,3.499,2.859,6.357,6.357,6.357
              		c3.499,0,6.358-2.859,6.358-6.357C18.358,955.271,15.499,952.412,12,952.412z M12,954.532c2.354,0,4.239,1.886,4.239,4.239
              		c0,2.354-1.886,4.239-4.239,4.239s-4.239-1.885-4.239-4.239C7.761,956.417,9.646,954.532,12,954.532z M12,965.113
              		c-3.13,0-5.971,0.849-8.091,2.275c-2.121,1.425-3.566,3.5-3.566,5.849v7.065c0,0.585,0.475,1.06,1.06,1.06h21.195
              		c0.584,0,1.06-0.475,1.06-1.06v-7.065c0-2.349-1.444-4.424-3.565-5.849C17.972,965.962,15.131,965.113,12,965.113z M12,967.233
              		c2.741,0,5.199,0.759,6.911,1.909c1.71,1.151,2.626,2.618,2.626,4.095v6.006H2.462v-6.006c0-1.477,0.917-2.943,2.627-4.095
              		C6.801,967.992,9.26,967.233,12,967.233z"></path>
                                      </g>
                                  </svg>
                <p class="text">
                    <span data-toggle="modal" data-target="#login-modal">
                        <?= t('Login') ?>
                    </span>
                   <!-- /
                    <span id="signup-label" data-url="<?/*= url_to(['user/register']) */?>">
                            <?/*= t('Signup') */?>
                    </span>-->
                </p>

        </span>
            <?
        } else {
            ?>
            <span class="register">
             <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                  x="0px" y="0px" width="25px" height="25px"
                  viewBox="0 0 24 29" enable-background="new 0 0 24 29" xml:space="preserve">
                                      <g transform="translate(0,-952.36218)">
                                          <path fill="#777777" d="M12,952.412c-3.499,0-6.357,2.859-6.357,6.359c0,3.499,2.859,6.357,6.357,6.357
              		c3.499,0,6.358-2.859,6.358-6.357C18.358,955.271,15.499,952.412,12,952.412z M12,954.532c2.354,0,4.239,1.886,4.239,4.239
              		c0,2.354-1.886,4.239-4.239,4.239s-4.239-1.885-4.239-4.239C7.761,956.417,9.646,954.532,12,954.532z M12,965.113
              		c-3.13,0-5.971,0.849-8.091,2.275c-2.121,1.425-3.566,3.5-3.566,5.849v7.065c0,0.585,0.475,1.06,1.06,1.06h21.195
              		c0.584,0,1.06-0.475,1.06-1.06v-7.065c0-2.349-1.444-4.424-3.565-5.849C17.972,965.962,15.131,965.113,12,965.113z M12,967.233
              		c2.741,0,5.199,0.759,6.911,1.909c1.71,1.151,2.626,2.618,2.626,4.095v6.006H2.462v-6.006c0-1.477,0.917-2.943,2.627-4.095
              		C6.801,967.992,9.26,967.233,12,967.233z"></path>
                                      </g>
                                  </svg>
                 <p class="text">
                    <span id="signup-label" data-url="<?= url_to(['profile/index']) ?>">
                       <b> <?= Yii::$app->user->identity->name ?></b>
                    </span>

                    <span id="signup-label" data-url="<?= url_to(['site/logout']) ?>">
                            <?= t('Logout') ?>
                    </span>
                </p>

                 </span>
            <?
        }
        ?>

        <div class="basket" data-toggle="modal" data-target="#product-basket">
            <!--        <div class="basket show-card-modal" >-->
            <div class="icon">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                     x="0px" y="0px" width="25px" height="25px"
                     viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
                            <g>
                                <g>
                                    <path fill="#777777" d="M27.764,18.879c1.226,0,2.221-0.996,2.221-2.221V8.775c0-1.225-0.995-2.221-2.221-2.221H7.539
			c-0.198-0.558-0.506-1.09-0.877-1.461L1.896,0.326c-0.434-0.434-1.137-0.434-1.57,0c-0.434,0.433-0.434,1.137,0,1.57l4.767,4.767
			c0.224,0.224,0.46,0.794,0.46,1.111v14.438c0,1.225,0.996,2.221,2.222,2.221h0.494c-0.644,0.584-1.05,1.424-1.05,2.359
			c0,1.761,1.433,3.192,3.192,3.192c1.761,0,3.193-1.432,3.193-3.192c0-0.936-0.406-1.775-1.049-2.359h10.429
			c-0.644,0.584-1.051,1.424-1.051,2.359c0,1.761,1.433,3.192,3.193,3.192s3.192-1.432,3.192-3.192c0-0.936-0.406-1.775-1.05-2.359
			h1.605c0.613,0,1.11-0.497,1.11-1.11c0-0.614-0.497-1.11-1.11-1.11H7.773v-3.333H27.764z M7.773,8.775h19.99l-0.004,7.883H7.773
			V8.775z M25.126,25.821c0.536,0,0.972,0.435,0.972,0.971c0,0.535-0.436,0.972-0.972,0.972s-0.972-0.437-0.972-0.972
			C24.154,26.256,24.59,25.821,25.126,25.821z M10.41,25.821c0.537,0,0.972,0.435,0.972,0.971c0,0.535-0.436,0.972-0.972,0.972
			c-0.535,0-0.971-0.437-0.971-0.972C9.439,26.256,9.875,25.821,10.41,25.821z"></path>
                                </g>
                            </g>
                            </svg>
                <i class="basket-icon basket-icon-header"></i>
                <span class="count cart-items-count"><?= Yii::$app->cart->countItems ?></span>
            </div>
            <p class="text"><?= t('Cart') ?></p>


        </div>

        <div class="language-switcher language-switcher-pills">
            <?php
            //            echo LanguageSwitcher::widget([
            //                'languages' => [
            //                    'ru' => 'Ру',
            //                    'uz' => "O'z",
            //                    'kr' => 'Ўз',
            //                ],
            //                'options' => [
            //                    'class' => 'nav nav-pills',
            //                ],
            //
            //            ]);
            ?>
        </div>

    </div>
</div>