<?php

$this->title = $model->title;
//$this->params['breadcrumbs'][] = t('Pages');
$this->params['breadcrumbs'][] = $this->title;
$this->metaTitle = $model->sub_title;
$this->metaImage = $model->image;

$pages = \common\models\Page::find()->active()->andWhere(['!=', 'id', $model->id])->all();

?>
<div class="main-block universal-page">
    <div class="auto-container main-container">
        <div class="sidebar">
            <div class="inner-sidebar">
                <ul class="sidebar-links">
                    <?php foreach ($pages as $page): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?= $page->url ?>">
                                <?= $page->getPageIcon() ?>
                                <span class="text" style="padding-left: 15px">
                                    <span><?= e($page->title) ?></span>
                                    <?= e($page->sub_title) ?>
                                </span>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
        <div class="article">
            <div class="universal-page__banner">
                <div class="img">
                    <img src="<?= $model->image ?>">
                </div>
            </div>
            <div class="content p-3 p-md-5">
                <?= \yii\helpers\HtmlPurifier::process($model->description) ?>
            </div>
        </div>
    </div>
</div>