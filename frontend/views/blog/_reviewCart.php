<?php
?>

<a href="<?= url_to(['blog/review', 'id' => $model->slug]) ?>" class="news-reviews__card-item">
    <div class="img">
        <img src="<?= $model->image_grid ?>">
    </div>
    <div class="content">
        <p class="name"><?= \yii\helpers\Html::encode($model->title) ?></p>
        <span class="date"><?= Yii::$app->formatter->asFullDateTimeUz($model->published_at) ?></span>
        <img src="/images/png/arrow-right.png" class="link-img">
    </div>
</a>
