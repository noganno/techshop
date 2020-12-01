<?php

use yii\bootstrap4\ActiveForm;

$this->title = t('Login to the site');
$this->params['breadcrumbs'][] = $this->title; ?>


<!-- Start of .reg-login -->
<div class="reg-login-2">
    <div class="auto-container">
        <div class="reg-login__inner container">
            <h1 class="title"><?= t('Login to the site') ?></h1>
            <p class="description">* - <?= t('Required fields.') ?></p>
            <?php $form = ActiveForm::begin(['options' => ['class' => 'reg-form-2 was-validated']]); ?>

            <div class="form-row">
                <?= $form->field($model, 'username', ['options' => ['class' => 'form-group for col-12 col-md-4']])->textInput([
                    'autofocus' => true,
                    'class' => 'form-control',
                    'placeholder' => t('Username')." *"
                ])->label(false) ?>
                <?= $form->field($model, 'password', ['options' => ['class' => 'form-group for col-12 col-md-4']])->passwordInput([
                    'class' => 'form-control',
                    'placeholder' => t('Password')." *"
                ])->label(false) ?>
            </div>

            <?= $form->field($model, 'reCaptcha')->widget(
                \himiklab\yii2\recaptcha\ReCaptcha2::className(),
                [
//                                        'siteKey' => 'your siteKey', // unnecessary is reCaptcha component was set up
                ]
            )->label(false) ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <?= \yii\helpers\Html::submitButton(t('Enter'), ['class' => 'btn btn-yellow-3 mt-4 mb-4', 'name' => 'login-button']) ?>
            <a class="btn btn-white-2"
               href="<?= url_to(['user/reset-password']) ?>"><?= t('Reset Fizik Password') ?></a>
           <!-- <a class="btn btn-white-2"
               href="<?/*= url_to(['user/register']) */?>"><?/*= t('Signup') */?></a>-->
            <?php ActiveForm::end(); ?>
            <br>
        </div>
    </div>
</div>
<!-- End of .reg-login -->

