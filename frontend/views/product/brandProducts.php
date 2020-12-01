<?php


$this->title = $brand->name;
$this->metaImage = $brand->image;
$sort = $dataProvider->getSort();
$this->params['breadcrumbs'][] = t("Brands");
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="main-block filter-product">
    <div class="auto-container container_left-sidebar-2">
        <?= $this->render('_brandLeftFilter', [
            'categories' => $categories,
            'brand' => $brand,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'filterMaxPrice' => $filterMaxPrice,
        ]); ?>
        <div class="article">
            <div class="product-wrapper-top">
                <div class="wrapper-block">
                    <div class="inner-block">
                        <span class="sort"><?= t('Sort') ?>: </span>
                        <p class="btn-links">
                            <?= $sort->link('price', [
                                'label' => fa('money') . " " . t('By price')
                            ]) ?>

                            <?= $sort->link('name', [
                                'label' => fa('font') . " " . t('Alphabetically')
                            ]) ?>

                            <?= $sort->link('popular', [
                                'label' => fa('star-o') . " " . t('By popularity')
                            ]) ?>
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
                <?php foreach ($dataProvider->getModels() as $model): ?>
                    <?= $this->render('_productCard', ['model' => $model]); ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <?= \frontend\components\TexnomartLinkPager::widget(['pagination' => $dataProvider->getPagination()]) ?>
</div>