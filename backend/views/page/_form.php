<?php

use kartik\switchinput\SwitchInput;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\helpers\Html;
use yeesoft\multilingual\widgets\ActiveForm;
use soft\kartik\SActiveForm;


?>

<div class="page-form">

    <?php $form = SActiveForm::begin(); ?>
    <?= $form->languageSwitcher($model) ?>

    <?= \soft\form\SForm::widget([
        'form' => $form,
        'model' => $model,
        'attributes' => [
            'title',
            'idn' => [
                'visible' => $model->isNewRecord,
            ],
            'sub_title',
            'image',
            'description' => [
                'type' => \soft\service\InputType::WIDGET,
                'widgetClass' => CKEditor::className(),

            ],
            'icon_class' => [
                'type' => \soft\service\InputType::WIDGET,
                'widgetClass' => InputFile::className(),
                'options' => [
                    'language' => 'ru',
                    'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
                    'filter' => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
                    'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
                    'options' => ['class' => 'form-control'],
                    'buttonOptions' => ['class' => 'btn btn-default'],
                    'multiple' => false       // возможность выбора нескольких файлов
                ]
            ],
            'status',
            'middle' => [
                'type' => \soft\service\InputType::SWITCH,
            ]
        ]
    ]) ?>
    <?= \soft\helpers\SHtml::submitButton() ?>
    <?php SActiveForm::end(); ?>

</div>