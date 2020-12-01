<?php

use common\models\Manufacturer;

$brands = Manufacturer::find()->where(['show_in_index_page' => true])->orderBy('sort_order')->all();
?>
<div class="brends">
    <div class="auto-container">
        <h1 class="title"><?= Yii::t('app', 'bistriy_perehod_brend') ?></h1>
        <div class="brends__carousel owl-carousel owl-theme">
            <?php foreach ($brands as $brand) : ?>
                <a href="<?=url_to(['product/brand','id'=>$brand->id]) ?>" class="item">
                    <img src="<?= $brand->image ?>">
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>