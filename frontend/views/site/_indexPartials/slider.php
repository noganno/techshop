<?php

use common\models\Slider;

$slider = Slider::findOne(3);

?>

<div class="banner">
    <div class="banner-carousel owl-carousel owl-theme">
        <?php foreach ($slider->getBehavior('galleryBehavior')->getImages() as $image) : ?>
            <div class="item">
                <img class="slider-link-item" href="<?= $image->description ?>" src="<?= $image->getUrl('original') ?>">
            </div>
        <?php endforeach ?>

    </div>
</div>

