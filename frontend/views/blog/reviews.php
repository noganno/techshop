<?php

    use yii\helpers\Html;
    $this->title = t('Reviews');
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-block-2 news-reviews">
    <div class="auto-container">
        <h1 class="title"><?= Html::encode($this->title) ?></h1>
        <div class="news-reviews__cards" style="justify-content: space-around">
        <?php foreach ($reviews['model'] as $model): ?>
            <?= $this->render('@frontend/views/blog/_reviewCart.php', ['model' => $model]) ?>
        <?php endforeach ?>
        </div>
    </div>
    <?= \frontend\components\TexnomartLinkPager::widget(['pagination' => $reviews['pagination'] ]) ?>
</div>