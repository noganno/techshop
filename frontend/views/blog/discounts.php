<?php

    use yii\helpers\Html;
    $this->title = t('Promotions and discounts');
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-block-2 news-reviews">
    <div class="auto-container">
        <h1 class="title"><?= Html::encode($this->title) ?></h1>
        <div class="news-reviews__cards" style="justify-content: space-around">
        <?php foreach ($discounts['model'] as $model): ?>
            <?= $this->render('@frontend/views/blog/_discountCart.php', ['model' => $model]) ?>
        <?php endforeach ?>
        </div>
    </div>
    <?= \frontend\components\TexnomartLinkPager::widget(['pagination' => $discounts['pagination'] ]) ?>
</div>