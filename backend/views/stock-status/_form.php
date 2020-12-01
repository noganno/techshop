<?php

use yii\helpers\Html;
use yeesoft\multilingual\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StockStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-status-form">

    <?php if (Yii::$app->session->hasFlash('message')) : ?>
        <div class="alert alert-info" role="alert">
            <?= Yii::$app->session->getFlash('message') ?>
        </div>
    <?php endif; ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->languageSwitcher($model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>