<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<!-- Start of .main-block -->
<div class="main-block thanks-page">

    <div class="auto-container thanks-page__block p-4 p-md-5">
        <div class="thanks-page__block-inner">
            <div class="icon">
                <?= \yii\helpers\Html::img('/images/png/warning.png') ?>
            </div>
            <h1 class="title"><?= Html::encode($this->title) ?></h1>
            <p class="title text-warning">
                <?= nl2br(Html::encode($message)) ?>
            </p>
            <a href="<?= \yii\helpers\Url::home() ?>" class="link-blue"><?= t('Home') ?></a>
        </div>
    </div>
</div>
<!-- End of .main-block -->
