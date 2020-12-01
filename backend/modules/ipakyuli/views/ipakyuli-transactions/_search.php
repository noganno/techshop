<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\ipakyuli\models\IpakyuliTransactionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ipakyuli-transactions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'global_id') ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'terminal_num') ?>

    <?php // echo $form->field($model, 'room') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'success_date') ?>

    <?php // echo $form->field($model, 'error_date') ?>

    <?php // echo $form->field($model, 'error_code') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'return_html') ?>

    <?php // echo $form->field($model, 'return_success_json') ?>

    <?php // echo $form->field($model, 'return_error_json') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
