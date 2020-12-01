<?php

use yii\bootstrap4\ActiveForm;

?>


<?php $form = ActiveForm::begin(['options' => ['class' => 'reg-form-2 was-validated']]); ?>

<?php if (!Yii::$app->session->get('smsSended')): ?>
    <div class="form-row">
        <?= $form->field($phone, 'username', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
            'class' => 'registration-phone form-control',
//            'required' => 'required',
            'placeholder' => t('Phone')
        ])->label(false) ?>
    </div>
<?php else: ?>
    <div class="form-row">
        <?= $form->field($phone, 'username', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([

            'class' => 'registration-phone form-control',
//            'required' => 'required',
//            'readOnly' => true,
            'value' => Yii::$app->session->get('verifyPhoneNumber'),
            'placeholder' => t('Phone')
        ])->label(false) ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->get('smsSended')): ?>
    <div class="form-row">
        <?= $form->field($phone, 'code', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
            'class' => 'form-control',
            'placeholder' => Yii::t('app', 'Verify Code'),
            'type' => 'text'
        ])->label(false) ?>
    </div>
    <div class="form-row">
        <a class="ml-3 link"
           href="<?= \yii\helpers\Url::to(['user/resend-verify-code']) ?>"><?= t('Resend Verify Code') ?></a>
        <a class="ml-3 link"
           href="<?= \yii\helpers\Url::to(['user/change-phone-number']) ?>"><?= t('Change Phone Number') ?></a>
    </div>
<?php endif ?>

    <button type="submit"
            class="btn btn-yellow-3 mt-4"><?= Yii::$app->session->get('smsSended') ? t('Verify Number') : t('Get Code') ?></button>
    <a href="<?=url_to(['user/register','type'=>'legal'])?>" class="btn btn-white-2 mt-4"><?= t('Register for Legal') ?></a>

<?php ActiveForm::end(); ?>