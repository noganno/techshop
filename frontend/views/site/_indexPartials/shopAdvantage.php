<?php

//bolshe_vozmoznoshtey
use common\models\Page;

    $b_v = Page::find()->where(['middle' => 1, 'status' => 1])->limit(5)->all();


?>

<div class="shop-advantage">
    <div class="auto-container">
        <h1 class="title"><?= Yii::t('app', 'bolshe_vozmoshnostey') ?></h1>
        <div class="shop-advantage__cards">
            <?php foreach ($b_v as $page) : ?>
                <a href="<?= url_to(['site/page', 'id' => $page->idn]) ?>" class="shop-advantage__cards-item">
                    <div class="img">
                        <img src="<?= $page->icon_class ?>">
                    </div>
                    <h1 class="title"><?= e($page->title) ?></h1>
                    <p class="text">
                        <?= e($page->sub_title) ?>
                    </p>
                    <img class="link" src="/images/icons/right.png">
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>