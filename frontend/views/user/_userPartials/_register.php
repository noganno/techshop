<?php

use kartik\date\DatePicker;
use yii\bootstrap4\ActiveForm;

/** @var $person \frontend\models\SignupForm */
?>


<?php $form = ActiveForm::begin(['options' => ['class' => 'reg-form-2']]); ?>


<?= $form->field($person, 'phone')->textInput([
    'value' => Yii::$app->session->get('verifyPhoneNumber'),
    'hidden' => true,
])->label(false) ?>

    <div class="form-row">
        <?= $form->field($person, 'last_name', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
            'autofocus' => true,
            'class' => 'form-control',
            'placeholder' => 'Имя*'
        ])->label(false) ?>
        <?= $form->field($person, 'first_name', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
            'class' => 'form-control',
            'placeholder' => 'Фамилия*'
        ])->label(false) ?>
        <?= $form->field($person, 'middle_name', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
            'class' => 'form-control',
            'placeholder' => 'Очество'
        ])->label(false) ?>
    </div>

    <div class="form-row">
        <div class="form-group col-12 col-md-4">

            <h5 class="ml-3"><?= Yii::$app->session->get('verifyPhoneNumber') ?></h5>

            <a class="ml-3 link"
               href="<?= \yii\helpers\Url::to(['user/change-phone-number']) ?>"><?= t('Change Phone Number') ?></a>

        </div>
        <?= $form->field($person, 'email', [
            'options' => [
                'class' => 'form-group col-12 col-md-4',
            ]])->textInput([
            'class' => 'form-control',
            'placeholder' => 'E-mail',
            'type' => 'email'
        ])->label(false) ?>

        <?= $form->field($person, 'username', [
            'options' => [
                'class' => 'form-group col-12 col-md-4',
            ]])->textInput([
            'class' => 'form-control',
            'placeholder' => t('Username'),
        ])->label(false) ?>


    </div>

    <div class="form-row">

        <?= $form->field($person, 'birth_date', [
            'options' => [
                'class' => 'form-group col-12 col-md-4',
            ]])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => t('Birth date')],
            'pickerIcon' => '<i class="fa fa-calendar kv-dp-icon"></i>',
            'removeIcon' => '<i class="fa fa-times kv-dp-icon"></i>',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ])->label(false) ?>

        <?= $form->field($person, 'gender', [
            'options' => [
                'class' => 'form-group col-12 col-md-4',
            ]])->radioList([
            '1' => t('Erkak'),
            '0' => t('Ayol'),
        ])->label(false) ?>

        <?= $form->field($person, 'address', [
            'options' => [
                'class' => 'form-group col-12 col-md-4',
            ]])->textInput([
            'class' => 'form-control',
            'placeholder' => t('Address'),
        ])->label(false) ?>


    </div>

    <div class="form-row">
    </div>

    <div class="form-row mt-3 pt-5 border-top">
        <?= $form->field($person, 'password', ['options' => ['class' => 'form-group col-12 col-md-4 show-password']])->passwordInput([
            'placeholder' => 'Пароль*',
        ])->label(false) ?>

        <?= $form->field($person, 'password_repeat', ['options' => ['class' => 'form-group col-12 col-md-4']])->passwordInput([
            'class' => 'form-control',
            'placeholder' => 'Повторите пароль*',
        ])->label(false) ?>

    </div>

    <div class="form-row">
        <div class="form-group col-12 col-md-4">
            <?= $form->field($person, 'reCaptcha')->widget(
                \himiklab\yii2\recaptcha\ReCaptcha2::className())->label(false) ?>
        </div>
        <div class="form-group col-12 col-md-8">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input"
                       id="jismoniy-shart-rozilik" required>
                <label class="custom-control-label" for="jismoniy-shart-rozilik">Я
                    принимаю <a href="#">условия использования сервиса</a></label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="jismoniy-sale">
                <label class="custom-control-label" for="jismoniy-sale">Получать
                    интересные предложения об акциях и скидках</label>
            </div>

        </div>
    </div>

    <button type="submit" class="btn btn-yellow-3 mt-4">Создат аккаунт</button>
<?php ActiveForm::end(); ?>