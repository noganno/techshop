<a href="<?= url_to(['blog/discount', 'id' => $model->slug]) ?>" class="news-reviews__card-item">
    <div class="img">
        <img src="<?= $model->image_grid ?>">
    </div>
    <div class="content">
        <p class="name"><?= \yii\helpers\Html::encode($model->title) ?></p>
        <span class="<?= $model->isGoingOn ? 'new' : 'old' ?>-date mt-5 mb-3">
           <?= $model->timeStatus ?>
        </span>
        <img src="/images/png/arrow-right.png" class="link-img">
    </div>
</a>
