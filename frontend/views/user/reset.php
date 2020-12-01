<?php

use yii\bootstrap4\ActiveForm;

$this->title = t('Reset Password');
$this->params['breadcrumbs'][] = $this->title; ?>


<!-- Start of .reg-login -->
<div class="reg-login-2">
    <div class="auto-container">
        <div class="reg-login__inner container">
            <h1 class="title"><?= $this->title ?></h1>
            <p class="description"><?= t('Required fields') ?></p>
            <?php $form = ActiveForm::begin(['options' => ['class' => 'reg-form-2 was-validated']]); ?>

            <?php if ($model->scenario == "captcha"): ?>
                <div class="form-row">
                    <?= $form->field($model, 'username', ['options' => ['class' => 'form-group for col-12 col-md-4']])->textInput([
                        'autofocus' => true,
                        'class' => 'form-control',
                        'required' => 'required',
                        'placeholder' => t('Username')
                    ])->label(false) ?>

                </div>
                <?= $form->field($model, 'reCaptcha')->widget(
                    \himiklab\yii2\recaptcha\ReCaptcha2::className(),
                    [
//                                        'siteKey' => 'your siteKey', // unnecessary is reCaptcha component was set up
                    ]
                )->label(false) ?>
            <?php endif ?>

            <?php if ($model->scenario == "verify"): ?>
                <div class="form-row">
                    <?= $form->field($model, 'code', ['options' => ['class' => 'form-group for col-12 col-md-4']])->textInput([
                        'autofocus' => true,
                        'class' => 'form-control',
                        'required' => 'required',
                        'placeholder' => t('Code')
                    ])->label(false) ?>

                </div>
            <?php endif ?>

            <?= \yii\helpers\Html::submitButton(t('Sign in'), ['class' => 'btn btn-yellow-3 mt-4 mb-4', 'name' => 'login-button']) ?>
            <a class="btn btn-white-2"
               href="<?= url_to(['user/reset-password']) ?>"><?= t('Reset Fizik Password') ?></a>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
<!-- End of .reg-login -->

