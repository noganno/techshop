<?php

    use frontend\models\LoginForm;
    use yii\bootstrap4\ActiveForm;

    $model = new LoginForm();
?>

<?php $form = ActiveForm::begin([
    'action'  => ['site/login'],
    'options' => ['class' => 'modal-content reg-form-2 was-validated']
]); ?>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle">
        <?= t('Login to the site') ?>
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <p class="description">* - <?= t('Required fields.') ?></p>

    <div class="form-row">
        <?= $form->field($model, 'username', ['options' => ['class' => 'form-group for col-12 col-md-4']])->textInput([
            'autofocus'   => true,
            'class'       => 'form-control',
            'required'    => true,
            'placeholder' => t('Username') . " *"
        ])->label(false) ?>
        <?= $form->field($model, 'password', ['options' => ['class' => 'form-group for col-12 col-md-4']])->passwordInput([
            'class'       => 'form-control',
            'required'    => true,
            'placeholder' => t('Password') . " *"
        ])->label(false) ?>
    </div>

    <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha2::className())->label(false) ?>
    <?= $form->field($model, 'rememberMe')->checkbox() ?>

    <?= \yii\helpers\Html::submitButton(t('Enter'), ['class' => 'btn btn-yellow-3 mt-4 mb-4', 'name' => 'login-button']) ?>
    <a class="btn btn-white-2"
       href="<?= url_to(['user/reset-password']) ?>"><?= t('Reset Fizik Password') ?></a>
    <!--<a class="btn btn-white-2"
       href="<?/*= url_to(['user/register']) */?>"><?/*= t('Signup') */?></a>-->
</div>
<?php ActiveForm::end(); ?>

