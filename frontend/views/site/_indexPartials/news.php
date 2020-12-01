<?php


$latestNews = \backend\modules\postmanager\models\News::find()->active()->latest(4)->all();
$latestReviews = \backend\modules\postmanager\models\Review::find()->active()->latest(4)->all();
?>
<div class="news">
    <div class="auto-container">
        <h1 class="title"><?= Yii::t('app', 'novosti_obzori') ?></h1>
        <div class="news__carousel owl-carousel owl-theme">
            <?php for ($i = 0; $i < 4; $i++): ?>

                <?php if (isset($latestNews[$i])): ?>
                    <a href="<?= url_to(['blog/news', 'id' => $latestNews[$i]->slug]) ?>" class="item">
                        <div class="content">
                            <span class="date">
                                <?= Yii::$app->formatter->asDateUz($latestNews[$i]->published_at) ?>
                                <span class="pull-right"><?= t('News') ?></span>
                            </span>

                            <h1 class="title"><?= e($latestNews[$i]->title) ?></h1>
                        </div>
                        <img src="<?= $latestNews[$i]->image_index ?>">
                    </a>
                <?php endif ?>

                <?php if (isset($latestReviews[$i])): ?>
                    <a href="<?= url_to(['blog/review', 'id' => $latestReviews[$i]->slug]) ?>" class="item">
                        <div class="content">
                            <span class="date">
                                <?= Yii::$app->formatter->asDateUz($latestReviews[$i]->published_at) ?>
                                <span class="pull-right"><?= t('Reviews') ?></span>
                            </span>
                            <h1 class="title"><?= e($latestReviews[$i]->title) ?></h1>
                        </div>
                        <img src="<?= $latestReviews[$i]->image_index ?>">
                    </a>
                <?php endif ?>
            <?php endfor ?>
        </div>
    </div>
</div>