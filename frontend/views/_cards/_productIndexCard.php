
<?php
use yii\helpers\Html;
/** @var $model \frontend\models\Product*/


?>
<div class="products-cards__item bestseller_new_recommended" data-id="<?= $model->id ?>">
    <?= $model->getProductLabel() ?>
    <?= $model->getDiscountRedText() ?>
    <a href="<?= $model->detailUrl ?>" class="img">
        <img src="/thumb.php?src=<?= '/frontend/web'.$model->getImage('card') ?>&w=140&h=140&a=t&zc=3">
    </a>
    <div class="content">
        <span class="category"><?= Html::encode($model->categoryName) ?></span>
        <a href="<?= $model->detailUrl ?>" class="name">
            <?= $model->name ?>
        </a>
        <h3 class="price">
            <?= $model->getDiscountOldDeletedText() ?>
            <span><?= Yii::$app->formatter->asSum($model->sale_price) ?></span>
        </h3>
        <!--        <p class="description">В месяц по 120 000 сум Предоплата 10% </p>-->
        <div class="btns">
            <span href="#" class="btn btn-yellow add-to-cart" data-product-id="<?= $model->id ?>">
               <?= Yii::$app->help->getCardSvg() ?>
               <?= Yii::t('app', 'v_korzinu') ?>
            </span>
            <a href="<?=\yii\helpers\Url::to(['balance/add-to-balance','id'=>$model->id])?>" class="btn btn-balance add-to-balance" data-product-id="<?= $model->id ?>">
                <?= Yii::$app->help->getBalanceSvg() ?>

            </a>
        </div>
    </div>
</div>