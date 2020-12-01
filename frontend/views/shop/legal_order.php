<?php


?>
<!-- Start of .main-block -->
<div class="main-block ordering">
    <?php $form = \yii\widgets\ActiveForm::begin(['options' => ['id' => 'form-signup', 'class' => 'auto-container']]); ?>
    <div class="container">
        <h1 class="title"><?= Yii::t('app', 'kupit_po_beznalichnimu') ?></h1>
        <p class="text"><?= Yii::t('app', 'polya_obyazatel') ?></p>

        <div class="form-row">
            <?= $form->field($model, 'fio', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
                'autofocus' => true,
                'class' => 'form-control',
                'placeholder' => Yii::t('app', 'name') . "*"
            ])->label(false) ?>

            <?= $form->field($model, 'inn', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
                'autofocus' => true,
                'class' => 'form-control',
                'placeholder' => Yii::t('app', 'inn: 123456789') . "*"
            ])->label(false) ?>

            <?= $form->field($model, 'company_name', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
                'autofocus' => true,
                'class' => 'form-control',
                'placeholder' => Yii::t('app', 'company_name') . "*"
            ])->label(false) ?>
        </div>

        <div class="form-row">

            <?= $form->field($model, 'phone', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
                'class' => 'registration-phone form-control',
                'placeholder' => Yii::t('app', 'phone') . "*",
                'type' => 'tel'
            ])->label(false) ?>
            <?= $form->field($model, 'email', [
                'options' => [
                    'class' => 'form-group col-12 col-md-4',
                ]])->textInput([
                'class' => 'form-control',
                'placeholder' => 'E-mail',
                'type' => 'email'
            ])->label(false) ?>

        </div>
        <div class="form-row">

            <?= $form->field($model, 'product_info', [
                'options' => [
                    'class' => 'form-group col-12 col-md-4',
                ]])->textarea([
                    'rows' => 10,
                'class' => 'form-control',
                'placeholder' => Yii::t('app', 'product_info'),
            ])->label(false) ?>

        </div>

        <div class="form-row">
            <div class="form-group col-12 col-md-4">
                <?= $form->field($model, 'reCaptcha')->widget(
                    \himiklab\yii2\recaptcha\ReCaptcha2::className(),
                    [
//                            'siteKey' => 'your siteKey', // unnecessary is reCaptcha component was set up
                    ]
                )->label(false) ?>
            </div>
            <div class="form-group col-12 col-md-8">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input"
                           id="jismoniy-shart-rozilik" required>
                    <label class="custom-control-label" for="jismoniy-shart-rozilik">Я
                        принимаю <a href="#">условия использования сервиса</a></label>
                </div>
            </div>
        </div>

        <?= \yii\helpers\Html::submitButton(Yii::t('app', 'send'), ['class' => 'btn btn-yellow-3 mt-4']) ?>
        <?php \yii\widgets\ActiveForm::end(); ?>
    </div>

</div>
<!-- End of .main-block -->