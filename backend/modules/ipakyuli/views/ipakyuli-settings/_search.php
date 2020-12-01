<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\ipakyuli\models\IpakyuliSettingsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ipakyuli-settings-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'test_key') ?>

    <?= $form->field($model, 'main_key') ?>

    <?= $form->field($model, 'terminal_num') ?>

    <?= $form->field($model, 'room_enter_name') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'success_url') ?>

    <?php // echo $form->field($model, 'error_url') ?>

    <?php // echo $form->field($model, 'redirect_url') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
