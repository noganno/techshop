<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\ipakyuli\models\IpakyuliTransactions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ipakyuli-transactions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'global_id')->textInput() ?>

    <?= $form->field($model, 'order_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'terminal_num')->textInput() ?>

    <?= $form->field($model, 'room')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'success_date')->textInput() ?>

    <?= $form->field($model, 'error_date')->textInput() ?>

    <?= $form->field($model, 'error_code')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'return_html')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'return_success_json')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'return_error_json')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
