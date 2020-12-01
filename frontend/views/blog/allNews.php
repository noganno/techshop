<?php

    use yii\helpers\Html;
    $this->title = t('News');
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-block-2 news-reviews">
    <div class="auto-container">
        <h1 class="title"><?= Html::encode($this->title) ?></h1>
        <div class="news-reviews__cards" style="justify-content: space-around">
        <?php foreach ($news['model'] as $model): ?>
            <?= $this->render('@frontend/views/blog/_newsCart.php', ['model' => $model]) ?>
        <?php endforeach ?>
        </div>
    </div>
    <?= \frontend\components\TexnomartLinkPager::widget(['pagination' => $news['pagination'] ]) ?>
</div>