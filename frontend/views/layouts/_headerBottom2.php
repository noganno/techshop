<?php
use yii\helpers\Url;
$region = Yii::$app->help->activeRegion;

use soft\widget\LanguageSwitcher;

?>

<?php if ($this->beginCache("headerbottom4", ['duration' => Yii::$app->params['pageCache']])): ?>

    <div class="header-bottom-2 sticky-top">
        <nav class="navbar navbar-expand-xl d-flex d-xl-none navbar-light bg-light sticky-top">
            <a class="navbar-brand mr-auto" href="<?= url_to(['site/index']) ?>">
                <img src="/images/logo.png" height="50px">
            </a>

            <div id="header-region-mobile">
				<span id="header-region-mobile__dropdown">
                     <?php echo $this->renderDynamic('return Yii::$app->help->activeRegion->name;'); ?><i class="fa fa-angle-down"></i>
				</span>
                <div id="bg-color-mobile" class="<?= $region ? "" : "bg-color-show" ?>"></div>
                <ul id="header-region-mobile__dropdown-block" class="<?= $region ? "" : "dropdown-block-show" ?>">
                    <?php foreach (\common\models\Towns::find()->where(['status' => 1])->all() as $town): ?>
                        <li><a class="myNav-bar__item-dropdown-item"
                               href="<?= Url::to(['site/select-region', 'id' => $town->id]) ?>"><?= $town->name ?></a>
                        </li>

                    <?php endforeach; ?>
                </ul>
            </div>

            <button class="navbar-toggler float-right" type="button" data-toggle="collapse"
                    data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <br>
                <!-- <div class="language-switcher language-switcher-pills">
                <?php
                /*                echo LanguageSwitcher::widget([
                                    'languages' => [
                                        'ru' => 'Ру',
                                        'uz' => "O'z",
                                        'kr' => 'Ўз',
                                    ],
                                    'options' => [
                                        'class' => 'nav nav-pills',
                                    ],

                                ]);
                                */?>
            </div>-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <i class="fa fa-list"></i>
                        <a class="nav-link" href="<?= url_to(['/site/catalog']) ?>">
                            <?= Yii::t('app', 'Categories') ?>
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item <?= $this->route == 'site/sklad-map' ? 'active' : '' ?>">
                        <i class="fa fa-cart-arrow-down"></i>
                        <a class="nav-link" href="<?= url_to(['site/sklad-map']) ?>">
                            <?= Yii::t('app', 'our_magazines') ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <i class="fa fa-map-marker"></i>
                        <a class="nav-link"
                           href="<?= url_to(['site/page', 'id' => 'purchase-on-loan']) ?>"><?= Yii::t('app', 'qarzga_olish') ?></a>
                    </li>
                    <li class="nav-item <?= $this->route == 'blog/discounts' ? 'active' : '' ?>">
                        <i class="fa fa-clock-o"></i>
                        <a class="nav-link" href="<?= url_to(['blog/discounts']) ?>"><?= Yii::t('app', 'aksiya') ?></a>
                    </li>
                    <li class="nav-item">
                        <i class="fa fa-percent"></i>
                        <a class="nav-link"
                           href="<?= url_to(['site/page', 'id' => 'about']) ?>"><?= Yii::t('app', 'company') ?></a>
                    </li>
                    <li class="nav-item">
                        <i class="fa fa-cog"></i>
                        <a class="nav-link"
                           href="<?= url_to(['site/page', 'id' => 'warranty']) ?>"><?= Yii::t('app', 'garantiya_na_tovari') ?></a>
                    </li>
                    <li class="nav-item">
                        <i class="fa fa-check-circle-o"></i>
                        <a class="nav-link"
                           href="<?= url_to(['site/page', 'id' => 'purchase-online']) ?>"><?= Yii::t('app', 'payment') ?></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <?php $this->endCache(); ?>
<?php endif ?>