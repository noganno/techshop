<?php

use kartik\widgets\ActiveForm;

$this->title = t('Reset password');
$this->params['breadcrumbs'][] = $this->title; ?>


<!-- Start of .reg-login -->
<div class="reg-login-2">
    <div class="auto-container">
        <div class="reg-login__inner container">
            <h1 class="title"><?= $this->title ?></h1>
            <p class="description"><?= t('Please fill out your phone number. A code to reset password will be sent to your number.') ?></p>
            <?php $form = ActiveForm::begin(['options' => ['class' => 'reg-form-2 was-validated']]); ?>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => "+999 (99) 999-99-99",
                    ]) ?>
                    <?= $form->field($model, 'reCaptcha')->widget(
                        \himiklab\yii2\recaptcha\ReCaptcha2::className(),
                        )->label(false) ?>
                </div>
            </div>

            <?= \yii\helpers\Html::submitButton(t('Get Code'), ['class' => 'btn btn-yellow-3 mt-4 mb-4', 'name' => 'login-button']) ?>
            <?php ActiveForm::end(); ?>
            <br>
        </div>
    </div>
</div>
<!-- End of .reg-login -->

