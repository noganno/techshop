<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['user/verify-email', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p><?=t('Hello')?> <?= Html::encode($user->username) ?>,</p>

    <p><?=t("Follow the link below to verify your email:")?></p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
