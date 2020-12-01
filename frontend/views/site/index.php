<?php

use yii\helpers\Url;
$this->title = "Texnomart";

?>
<?php if ($this->beginCache("indexPartials", ['duration' => Yii::$app->params['pageCache']])): ?>


    <!-- hidden mobile navbar -->
    <!-- Start of .banner -->
    <?= $this->render('@frontend/views/site/_indexPartials/slider.php'); ?>
    <!-- End of .banner -->

    <!-- Start of .special-offer -->
    <?= $this->render('@frontend/views/site/_indexPartials/specialOffer.php'); ?>
    <!-- End of .special-offer -->



    <?php $this->endCache(); ?>
<?php endif ?>


<!-- Start of .products - Товары которые чаще всего покупают в нашем магазине -->
<?= $this->render('@frontend/views/site/_indexPartials/products.php'); ?>

<!-- End of .products -->

<!-- Start of .brends -->
<? //= $this->render('@frontend/views/site/_indexPartials/brands.php'); ?>
<!-- End of .brends -->

<!-- Start of .deals -->
<? // $this->render('@frontend/views/site/_indexPartials/deals.php'); ?>
<!-- End of .deals -->

<!-- Start of .shop-advantage -->
<?= $this->render('@frontend/views/site/_indexPartials/shopAdvantage.php'); ?>
<!-- End of .shop-advantage -->

<!-- Start of .news -->
<?= $this->render('@frontend/views/site/_indexPartials/news.php'); ?>
<!-- End of .news -->

<!-- Start of .advertisement -->
<?= $this->render('@frontend/views/site/_indexPartials/advertisement.php'); ?>

<!-- End of .advertisement -->

<!-- Start of .recently-products -->
<?= $this->render('@frontend/views/site/_indexPartials/recentlyProducts.php'); ?>

<!-- End of .recently-products -->