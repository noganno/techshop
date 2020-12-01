<?php

use yii\helpers\Html;
use yeesoft\multilingual\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AttributeGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attribute-group-form">

    <?php if (Yii::$app->session->hasFlash('message')) : ?>
        <div class="alert alert-info" role="alert">
            <?= Yii::$app->session->getFlash('message') ?>
        </div>
    <?php endif; ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>