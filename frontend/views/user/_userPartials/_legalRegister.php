<?php

use yii\bootstrap4\ActiveForm;

?>

<?php $form = ActiveForm::begin(['options' => ['class' => 'reg-form-2']]); ?>

<div class="form-row">
    <?= $form->field($model, 'username', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
        'autofocus' => true,
        'class' => 'form-control',
        'placeholder' => t('Login')
    ])->label(false) ?>
    <?= $form->field($model, 'inn', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
        'class' => 'form-control',
        'placeholder' => t('Inn')
    ])->label(false) ?>
    <?= $form->field($model, 'email', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
        'class' => 'form-control',
        'placeholder' => t('Email')
    ])->label(false) ?>
</div>


<div class="form-row">
    <?= $form->field($model, 'company_name', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
        'class' => 'form-control',
        'placeholder' => t('Company Name')
    ])->label(false) ?>
    <?= $form->field($model, 'password', ['options' => ['class' => 'form-group col-12 col-md-4 show-password']])->passwordInput([
        'class' => 'password-input form-control',
        'placeholder' => t('Password')
    ])->label(false) ?>
    <?= $form->field($model, 'password_repeat', ['options' => ['class' => 'form-group col-12 col-md-4']])->passwordInput([
        'class' => 'form-control',
        'placeholder' => t('Password Repeat')
    ])->label(false) ?>
</div>


<button type="submit" class="btn btn-yellow-3">Создат аккаунт</button>
<a href="<?=url_to(['user/register'])?>" class="btn btn-white-2"><?=t('Register for jismoniy')?></a>

<!-- Button trigger modal -->
<!--<p class="btn-text mt-3" data-toggle="modal" data-target="#yuridik-modal">Форма поддержки-->
<!--    пользователей</p>-->

<!-- Modal -->
<?php ActiveForm::end(); ?>
