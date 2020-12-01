<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = t('Change user data');
$this->params['breadcrumbs'][] = $this->title;


/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form ActiveForm */
?>
<div class="profile">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'surname') ?>
    <?= $form->field($model, 'father_name') ?>
    <?= $form->field($model, 'phone') ?>
    <?= $form->field($model, 'birth_date') ?>
    <?= $form->field($model, 'passport') ?>
    <?= Html::img(Yii::$app->user->identity->image, ['class' => 'img-circle', 'style' => [
                                'width'=>'100px'
    ]]) ?>
    <?= $form->field($model, 'image')->widget(\mihaildev\elfinder\InputFile::className(), [
        'language' => Yii::$app->language,
        'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
        'filter' => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
        'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options' => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
        'multiple' => false       // возможность выбора нескольких файлов
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- profile -->
