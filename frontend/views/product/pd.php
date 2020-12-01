
<?php

use soft\helpers\SHtml;

/** @var \frontend\models\Product $model */
/** @var \soft\web\SView $this */

$this->title = $model->name;
$this->metaTitle = $model->meta_title == '' ? $this->title : $model->meta_title;
$this->metaDescription = $model->meta_description;
$this->metaImage = $model->getImage('card');
$this->metaKeywords = $model->meta_keyword;

$category = $model->currentCategory;
$relatedProducts = [];
if ($category != null) {
    $relatedProducts = $category->findActiveProducts()->andWhere(['!=', 'product.id', $model->id])->limit(10)->all();
}


$mainCharacters = $model->getAttributeValues()
//    ->joinWith('attributeName')
//    ->andWhere('attribute.attribute_group_id=2')
    ->all();

$allAttributeGroups = $model->getAttributeGroups()->all();
$latestNews = \backend\modules\postmanager\models\News::find()->active()->latest(3)->all();

//dd($otherAttributeGroups);

#region Breadcrumbs

if ($category != null) {
    if ($category->lvl == 2) {
        $this->params['breadcrumbs'][] = [
            'label' => $category->parent->title,
            'url' => $category->parent->detailUrl,
        ];
    }
    if ($category->lvl == 3) {
        $this->params['breadcrumbs'][] = [
            'label' => $category->parent->parent->title,
            'url' => $category->parent->parent->detailUrl,
        ];
        $this->params['breadcrumbs'][] = [
            'label' => $category->parent->title, 'url' => $category->parent->detailUrl,
        ];
    }

    $this->params['breadcrumbs'][] = [
        'label' => $category->title, 'url' => $category->detailUrl,
    ];
}

#endregion

$this->params['breadcrumbs'][] = $this->title;


?>
<div class="main-block product-page">


    <div class="auto-container">
        <!-- Start of .product-page__info -->
        <div class="product-page__info">

            <div class="img">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                     aria-orientation="vertical">
                    <?php foreach ($model->getImages('cart') as $key => $image): ?>
                        <a class="nav-link <?= $key == 0 ? 'active' : '' ?>" id="v-pills-home-tab-<?= $key ?>"
                           data-toggle="pill" href="#v-pills-home-<?= $key ?>" role="tab" aria-selected="true">
                            <img src="<?= $image ?>">
                        </a>
                    <?php endforeach ?>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <?php
                    foreach ($model->getImages('detail') as $key => $image): ?>
                        <a href="<?= $image ?>" data-fancybox="gallery"
                           class="tab-pane fade <?= $key == 0 ? 'show active' : '' ?>" id="v-pills-home-<?= $key ?>"
                           role="tabpanel"
                           aria-labelledby="v-pills-home-tab">
                            <img src="<?= $image ?>">
                        </a>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="content">
                <span class="inStok"><?= $model->getStockStatus() ?></span>
                <h1 class="title"><?= ($model->name) ?></h1>
                <ul class="content-prices">

                    <?php if (intval($model->sale_price) > 0): ?>
                        <li>
                            <span class="text"><?= t('Sale Price') ?></span>
                            <span class="price"><?= Yii::$app->formatter->asSum($model->sale_price) ?></span>
                        </li>
                    <?php endif ?>
                    <!--    <?php /*if (intval($model->loan_price) > 0 ): */ ?>
                        <li>
                            <span class="text"><? /*= t('Loan Price') */ ?></span>
                            <span class="price"><? /*= Yii::$app->formatter->asSum($model->loan_price) */ ?></span>
                        </li>
                    --><?php /*endif */ ?>

                    <?php if ($model->price > $model->sale_price): ?>
                        <li>
                            <span class="text"><?= t('Old cost') ?></span>
                            <span class="price text line-through">
                                <?= Yii::$app->formatter->asSum($model->price) ?>
                            </span>
                        </li>
                        <li>
                            <span class="text"><?= t('Экономия') ?></span>
                            <span class="price text">
                                <?= Yii::$app->formatter->asSum($model->price - $model->sale_price) ?>
                            </span>
                        </li>
                    <?php endif ?>
                </ul>
                <div class="btns">
                    <?= Yii::$app->user->isGuest ? a(t('Fast order'), ['fast-order/show', 'id' => $model->id], [
                        'class' => 'btn btn-yellow fast-order-modal-button',
                        'role' => 'modal-remote',
                    ]) : "" ?>

                    <?php if (!Yii::$app->user->isGuest): ?>
                        <a herf="#" class="btn btn-yellow add-to-cart" data-product-id="<?= $model->id ?>"
                           data-toggle="modal" data-target="#product-basket">
                            <?= t('Купить') ?>
                        </a>
                    <?php endif ?>


                    <a herf="#" class="btn btn-yellow add-to-cart" data-product-id="<?= $model->id ?>"
                       data-toggle="modal" data-target="#product-rassrochka">
                        <?= t('В рассрочку') ?>
                    </a>
                    <!--                    <span href="#" class="btn btn-balance-2 add-to-cart" data-toggle="modal"
                          data-target="#product-basket" data-product-id="<? /*= $model->id */ ?>">


                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="-5px" y="0px"
                                     width="22px" height="22px" viewBox="0 0 30 30" enable-background="new 0 0 30 30"
                                     xml:space="preserve">
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

                            </span>-->
                    <a href="<?= \yii\helpers\Url::to(['balance/add-to-balance', 'id' => $model->id]) ?>"
                       class="btn btn-balance add-to-balance" data-product-id="<?= $model->id ?>">
                        <?= Yii::$app->help->getBalanceSvg() ?>
                    </a>

                </div>

                <div class="links">
                    <a href="<?= url_to(['site/page', 'id' => 'free-delivery']) ?>" class="link-grey">Бесплатная
                        доставка и поднятие до этажа</a>
                    <a href="<?= url_to(['site/page', 'id' => 'warranty']) ?>"
                       class="link-grey"><?= t('Warranty') ?></a>
                    <a href="<?= url_to(['site/page', 'id' => 'bonus-system']) ?>"
                       class="link-grey"><?= t('bonus_system') ?></a>
                </div>
            </div>
        </div>
        <!-- End of .product-page__info -->
    </div>
</div>


<div class="modal fade" id="product-vKarzinu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg p-2" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="main-block-2 product-page__description">
    <div class="auto-container container_right-sidebar">
        <div class="article">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <!--                <li class="nav-item">-->
                <!--                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"-->
                <!--                       aria-controls="home" aria-selected="true">-->
                <!--                        --><? //= t('Product description') ?>
                <!--                    </a>-->
                <!--                </li>-->
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="true"><?= t('Спецификации') ?></a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!--                <div class="description tab-pane fade show active" id="home" role="tabpanel"-->
                <!--                     aria-labelledby="home-tab">-->
                <!--                    --><? //= \yii\helpers\HtmlPurifier::process($model->description) ?>
                <!--                </div>-->
                <div class="specification tab-pane fade show active" id="profile" role="tabpanel"
                     aria-labelledby="profile-tab">
                    <div class="specification-item">
                        <h1 class="title"><?= t('Main characteristics') ?></h1>
                        <ul class="list">

                            <?php if ($model->country != null): ?>
                                <li>
                                    <span><?= t('Country') ?></span>
                                    <span><?= ($model->country->name) ?></span>
                                </li>
                            <?php endif ?>

                            <?php if ($model->manufacturer != null): ?>
                                <li>
                                    <span><?= t('Manufacturer') ?></span>
                                    <span><?= ($model->manufacturer->name) ?></span>
                                </li>
                            <?php endif ?>

                            <?php if ($model->model != ''): ?>
                                <li>
                                    <span><?= t('Model') ?></span>
                                    <span><?= ($model->model) ?></span>
                                </li>
                            <?php endif ?>

                            <?php if ($model->warranty != null): ?>
                                <li>
                                    <span><?= t('Warranty') ?></span>
                                    <span><?= ($model->warranty->name) ?></span>
                                </li>
                            <?php endif ?>


                            <?php if (!empty($mainCharacters)): ?>
                                <?php foreach ($mainCharacters as $mainCharacter): ?>
                                    <li>
                                        <span><?= ($mainCharacter->attributeName->title) ?></span>
                                        <span><?= de($mainCharacter->text) ?></span>
                                    </li>
                                <?php endforeach ?>
                            <?php endif ?>

                        </ul>
                    </div>

                    <?php if (false && !empty($allAttributeGroups)): ?>
                        <?php foreach ($allAttributeGroups as $group): ?>
                            <?php

                            $characters = $model->getAttributeValues()
                                ->joinWith('attributeName')
                                ->andWhere(['attribute.attribute_group_id' => $group->id])
                                ->all();

                            ?>

                            <?php if (true): ?>
                                <div class="specification-item">
                                    <h1 class="title"><?= ($group->title) ?></h1>
                                    <ul class="list">
                                        <?php foreach ($characters as $character): ?>
                                            <li>
                                                <span><?= ($character->attributeName->title) ?></span>
                                                <span><?= ($character->text) ?></span>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php endif ?>

                </div>
            </div>

        </div>
        <div class="sidebar">
            <div class="sidebar-inner sticky-top">

                <div class="news">
                    <?php foreach ($latestNews as $news): ?>

                        <a href="<?= url_to(['blog/news', 'id' => $news->slug]) ?>" class="news-item">
                            <div class="content">
                                <span class="date"> <?= Yii::$app->formatter->asDateUz($news->published_at) ?></span>
                                <h1 class="title"><?= ($news->title) ?></h1>
                                <span class="category"><?= t('News') ?></span>
                            </div>
                            <img src="<?= $news->image_index ?>">
                        </a>

                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($relatedProducts)): ?>
        <div class="auto-container">
            <div class="carousel">
                <h1 class="title"><?= t('Products that may also be interesting') ?></h1>
                <div class="carousel-cards owl-carousel owl-theme">
                    <?php foreach ($relatedProducts as $relatedProduct): ?>

                        <div class="products-cards__item bestseller_new_recommended">
                            <a href="<?= url_to(['product/detail', 'id' => $relatedProduct->slug]) ?>" class="img">
                                <img src="<?= $relatedProduct->getImage('card') ?>">
                            </a>
                            <div class="content">
                                <span class="category"><?= $relatedProduct->getCategoryName() ?></span>
                                <a href="<?= url_to(['product/detail', 'id' => $relatedProduct->slug]) ?>" class="name">
                                    <?= e($relatedProduct->name) ?>
                                </a>
                                <span class="price">
                                    <?= Yii::$app->formatter->asSum($relatedProduct->sale_price) ?>
                                </span>
                                <div class="btns">
                                    <span class="add-to-cart btn btn-yellow-2"
                                          data-product-id="<?= $relatedProduct->id ?>">
                                       <?= Yii::$app->help->getCardSvg() ?>
                                    </span>
                                    <a href="<?= url_to(['balance/add-to-balance', 'id' => $relatedProduct->id]) ?>"
                                       class="btn add-to-balance btn-balance">
                                        <?= Yii::$app->help->getBalanceSvg() ?>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php endforeach ?>
                </div>
            </div>
        </div>
    <?php endif ?>

</div>
