<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\ipakyuli\models\IpakyuliSettings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ipakyuli-settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'billing_url')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'test_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'main_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'terminal_num')->textInput() ?>

    <?= $form->field($model, 'room_enter_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['TESTING' => 'TESTING', 'WORKING' => 'WORKING',], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'success_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'error_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'redirect_url')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
