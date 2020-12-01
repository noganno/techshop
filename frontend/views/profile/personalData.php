<?php

use yii\bootstrap4\ActiveForm;

$this->title = t('Personal data');
$this->params['breadcrumbs'][] = t('Personal cabinet');
$this->params['breadcrumbs'][] = t('Personal data');

$css = <<<CSS

    div.required label:after{
        content: " *";
    }

CSS;


$this->registerCss($css);

?>
<!-- Start of .personal-page -->
<div class="main-block personal-page universal-page">

    <div class="auto-container main-container">
        <?= $this->render('_profileLeft') ?>
        <div class="article p-3 p-md-5">
            <h1 class="title"><?= $this->title ?></h1>
            <p class="description mt-2">* — <?= t('Required fields.') ?></p>
            <?php $form = ActiveForm::begin(); ?>
            <div class="form-row mt-5">
                <?= $form->field($model, 'surname', ['options' => ['class' => 'form-group col-md-6']])->textInput([
                    'autofocus' => true,
                    'readOnly' => true,
                    'placeholder' => t('Your lastname')
                ]) ?>

                <!--                --><? //= $form->field($model, 'town_id', ['options' => ['class' => 'form-group col-md-6']])->dropDownList(
                //                    \yii\helpers\ArrayHelper::map(\common\models\Towns::find()->all(), 'id', 'name'), [
                //                        'prompt' => t('Your town'),
                //                    ]
                //                ) ?>

                <?= $form->field($model, 'name', ['options' => ['class' => 'form-group col-md-6']])->textInput([
                    'readOnly' => true,

                    'placeholder' => t('Your name') . " *"
                ]) ?>

                <?= $form->field($model, 'phone', ['options' => ['class' => 'form-group col-md-6']])->widget(
                    \yii\widgets\MaskedInput::className(),

                    [
                        'options' => [
                            'readOnly' => true
                        ],
                        'mask' => "+999 (99) 999-99-99",
                    ]
                ) ?>

                <?= $form->field($model, 'father_name', ['options' => ['class' => 'form-group col-md-6']])->textInput([
                    'readOnly' => true,
                    'placeholder' => t('Your father name')
                ]) ?>

                <!--                --><? //= $form->field($model, 'payment_type_id', ['options' => ['class' => 'form-group col-md-6']])->dropDownList(
                //                    \yii\helpers\ArrayHelper::map(\common\models\PaymentTypes::find()->all(), 'id', 'name'), [
                //                        'prompt' => t('Preferred type of payment'),
                //                    ]
                //                ) ?>

                <?= $form->field($model, 'address', ['options' => ['class' => 'form-group col-md-12']])->textInput([
                    'readOnly' => true,
                    'placeholder' => t('Adress')
                ]) ?>

            </div>
            <div class="form-row mt-5">

                <?= $form->field($model, 'password', ['options' => ['class' => 'form-group col-md-6']])->passwordInput(['placeholder' => t('Please choose your new password'),
                    'id' => 'user-password',]) ?>

                <?= $form->field($model, 'repassword', ['options' => ['class' => 'form-group col-md-6']])->passwordInput(['placeholder' => t('Repeat new password')]) ?>
            </div>
            <button type="submit" class="btn btn-yellow-3 mt-3"><?= t('Save') ?></button>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>