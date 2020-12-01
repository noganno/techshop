<?php

use kartik\widgets\ActiveForm;

$this->title = t('Reset password');
$this->params['breadcrumbs'][] = $this->title; ?>


<!-- Start of .reg-login -->
<div class="reg-login-2">
    <div class="auto-container">
        <div class="reg-login__inner container">
            <h1 class="title"><?= $this->title ?></h1>
            <?php $form = ActiveForm::begin(['options' => ['class' => 'reg-form-2 was-validated']]); ?>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'code') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'password_repeat')->passwordInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'reCaptcha')->widget(
                        \himiklab\yii2\recaptcha\ReCaptcha2::className(),
                        )->label(false) ?>
                </div>
            </div>

            <?= \yii\helpers\Html::submitButton(t('Enter'), ['class' => 'btn btn-yellow-3 mt-4 mb-4', 'name' => 'login-button']) ?>
            <?php ActiveForm::end(); ?>
            <br>
        </div>
    </div>
</div>
<!-- End of .reg-login -->

