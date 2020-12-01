<?php

use yii\helpers\Html;
use yeesoft\multilingual\widgets\ActiveForm;
use kartik\widgets\SwitchInput
/* @var $this yii\web\View */
/* @var $model common\models\Towns */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="towns-form">
    <div class="category-form">
        <?php if (Yii::$app->session->hasFlash('message')) : ?>
            <div class="alert alert-info" role="alert">
                <?= Yii::$app->session->getFlash('message') ?>
            </div>
        <?php endif; ?>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($model) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'status')->widget(SwitchInput::classname(), []); ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>