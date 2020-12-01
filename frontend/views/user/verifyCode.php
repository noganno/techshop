<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\bootstrap4\ActiveForm;

$this->title = 'Verify Phone';
$this->params['breadcrumbs'][] = $this->title; ?>

    <!-- Start of .reg-login -->
    <div class="reg-login">
        <div class="auto-container">
            <div class="reg-login__inner">
                <h1 class="title"><?= Yii::t('app', 'Verification Phone') ?></h1>

                <!-- Start of .reg-form -->
                <?php $form = ActiveForm::begin([
                    'options' => ['class' => 'reg-form was-validated mt-5'],
                ]) ?>
                <div class="form-row">
                    <?= $form->field($model, 'username', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
                        'class' => 'registration-phone form-control',
                        'required' => 'required',
                        'placeholder' => 'Телефон*',
                        'type' => 'tel'
                    ])->label(false) ?>
                </div>
                <div class="form-row">
                    <?= $form->field($model, 'code', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
                        'class' => 'form-control',
                        'placeholder' => Yii::t('app', 'Verify Code'),
                        'type' => 'text'
                    ])->label(false) ?>
                    <div class="form-group col-md-12 mt-4">
                        <button type="submit" class="btn btn-yellow-3"><?= Yii::t('app', 'Resume') ?></button>
                    </div>
                </div>

                <?php ActiveForm::end() ?>
                <!-- End of .reg-form -->

            </div>
        </div>
    </div>
    <!-- End of .reg-login -->
<?php

?>