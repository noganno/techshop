<?php

use soft\helpers\SHtml;
use soft\kartik\SActiveForm;
use soft\form\SForm;


/* @var $this backend\components\BackendView */
/* @var $model backend\modules\usermanager\models\User */
/* @var $form soft\kartik\SActiveForm */
?>

<div class="">

    <div class="row"> <?php $form = SActiveForm::begin(); ?>
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput([
                'autofocus' => true,
            ]) ?>
        </div>
        <div class="col-md-6"> <?= $form->field($model, 'surname') ?></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'town_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(\common\models\Towns::find()->all(), 'id', 'name'), [
                    'prompt' => t('   '),
                ]
            ) ?></div>

        <div class="col-md-6"> <?= $form->field($model, 'name') ?></div>
    </div>
    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'phone')->widget(
                \yii\widgets\MaskedInput::className(),
                [
                    'mask' => "+999 (99) 999-99-99",
                ]
            ) ?>
        </div>
        <div class="col-md-6"> <?= $form->field($model, 'father_name') ?></div>
    </div>
    <div class="row">
        <div class="col-md-6"> <?= $form->field($model, 'payment_type_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(\common\models\PaymentTypes::find()->all(), 'id', 'name'), [
                    'prompt' => '',
                ]
            ) ?></div>
        <div class="col-md-6"> <?= $form->field($model, 'email') ?></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'address', ['options' => ['class' => 'form-group col-md-12']]) ?>
            <?= $form->field($model, 'guid', ['options' => ['class' => 'form-group col-md-12']]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'image', ['options' => ['class' => 'form-group col-md-12']])->widget(\mihaildev\elfinder\InputFile::class, [
                'language' => 'ru',
                'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
                'path' => 'image', // будет открыта папка из настроек контроллера с добавлением указанной под деритории
                'filter' => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
                'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
                'options' => ['class' => 'form-control'],
                'buttonOptions' => ['class' => 'btn btn-default'],
                'multiple' => false       // возможность выбора нескольких файлов
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6"> <?= $form->field($model, 'password')->passwordInput([
                'id' => 'user-password',
            ]) ?></div>
        <div class="col-md-6"> <?= $form->field($model, 'repassword')->passwordInput() ?></div>
    </div>
    <div style="clear: both"></div>

    <div class="form-group">
        <?= SHtml::submitButton() ?>
    </div>

    <?php SActiveForm::end(); ?>

</div>
