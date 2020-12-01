<?php

use common\models\SpecialOffer;

$special = SpecialOffer::find()->with('category')->all();

?>

<div class="special-offer">
    <div class="auto-container">
        <h1 class="title"><?= Yii::t('app', 'special_offer') ?></h1>
        <div class="special-offer__carousel owl-carousel owl-theme">
            <?php foreach ($special as $spec) : ?>
                <a href="<?= url_to(['product/category', 'id' => $spec->category->slug]) ?>" class="item">
                    <div class="content">
                        <h1 class="title"><?= $spec->title ?></h1>
                        <span class="link"><?= Yii::t('app', 'Read More') ?> <i class="fa fa-angle-right"></i></span>
                    </div>
                    <div class="img">
                        <img src="<?= $spec->image ?>">
                    </div>
                </a>
            <?php endforeach; ?>

        </div>
    </div>
</div>