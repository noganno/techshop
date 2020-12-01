<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => t('News'), 'url' => ['blog/all-news']];
$this->params['breadcrumbs'][] = $this->title;

$this->metaTitle = $model->meta_title == '' ? $this->title : $model->meta_title;
$this->metaDescription = $model->meta_description;
$this->metaImage = $model->image_grid;
$this->metaKeywords = $model->meta_keywords;

?>


<div class="main-block-2 post">
    <div class="auto-container">
        <div class="post-banner">
            <div class="img">
                <img src="<?= $model->image_detail ?>" alt="<?= $model->title ?>">
            </div>
        </div>
        <div class="post-page p-3 p-md-5">
            <h1 class="title"><?= Html::encode($model->title) ?></h1>
            <p class="date">
                <i class="fa fa-calendar"></i>
                <span>
                    <?= Yii::$app->formatter->asFullDateUz($model->published_at) ?>
                </span>
            </p>
            <div class="content">
                <?= HtmlPurifier::process($model->content) ?>
            </div>
            <a href="#" class="test-adever">
                <img src="/images/banner/test-reklama.png">
            </a>
        </div>
    </div>
</div>