<?php

use yii\bootstrap4\ActiveForm;

?>


<?php $form = ActiveForm::begin(['options' => ['class' => 'reg-form-2 was-validated']]); ?>
<?= $form->field($inn, 'phone', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
    'hidden' => true,
    'value' => $inn->getPhoneFromSession()
])->label(false) ?>

<?= $form->field($inn, 'inn', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
    'hidden' => true,
    'value' => $inn->getInn()
])->label(false) ?>


<?php if (Yii::$app->session->get('smsInnSended')): ?>
    <div class="pl-3">
        <p class="text-black"><?= t('Your Phone:') ?><span
                    class="text-info"> *****<?= substr(Yii::$app->session->get('verifyInnPhoneNumber'), -4) ?></span>
        </p>
        <p class="text-black"><?= t('Your INN:') ?><span class="text-info"> <?= $inn->inn ?></span></p>
        <p class="text-primary">Foydalanuvchining boshqa malumotlari shu yerda ko'rinadi</p>
    </div>
<?php else: ?>
    <div class="form-row">
        <?= $form->field($inn, 'inn', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([

            'class' => 'form-control',
//            'required' => 'required',
//            'readOnly' => true,
            'value' => Yii::$app->session->get('verifyPhoneNumber'),
            'placeholder' => t('Inn')
        ])->label(false) ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->get('smsInnSended') && !Yii::$app->session->get('tempUserInnVerified')): ?>
    <div class="form-row">
        <?= $form->field($inn, 'code', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
            'class' => 'form-control',
            'placeholder' => Yii::t('app', 'Verify Code'),
            'type' => 'text',
        ])->label(false) ?>
    </div>

    <div class="form-row">
        <a class="ml-3 link"
           href="<?= \yii\helpers\Url::to(['user/resend-inn-verify-code']) ?>"><?= t('Resend Verify Code') ?></a>
        <a class="ml-3 link"
           href="<?= \yii\helpers\Url::to(['user/change-phone-number']) ?>"><?= t('Change Phone Number') ?></a>
    </div>
<?php endif ?>


<?php if (Yii::$app->session->get('tempUserInnVerified')): ?>
    <div class="form-row">
        <?= $form->field($inn, 'password', ['options' => ['class' => 'form-group col-12 col-md-4 show-password']])->passwordInput([
            'placeholder' => t('password'),

        ])->label(false) ?>
    </div>

    <div class="form-row">

        <?= $form->field($inn, 'password_repeat', ['options' => ['class' => 'form-group col-12 col-md-4']])->passwordInput([
            'class' => 'form-control',
            'placeholder' => t('passwordRepeat'),
        ])->label(false) ?>
    </div>
<?php endif ?>


<?php if (Yii::$app->session->hasFlash('innPhoneVerifyCodeSent')): ?>
    <div class="ml-3 mt-2 form-row">
        <div class="alert alert-dismissible alert-danger">
            <?= Yii::$app->session->getFlash('innPhoneVerifyCodeSent') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
<?php endif ?>
    <button type="submit"
            class="btn btn-yellow-3 mt-4"><?= Yii::$app->session->get('smsInnSended') ? t('Verify Number') : t('Get Code') ?></button>
<?php ActiveForm::end(); ?>