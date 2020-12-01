<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\c1manager\models\C1Manager */
/* @var $form ActiveForm */
?>
<div class="update">

    <?php $form = ActiveForm::begin(); ?>


    <h3><?= $model->description ?></h3>
    <br>
        <?= $form->field($model, 'description') ?>

    <?php if ($model->name != "auth_keys"): ?>
        <?= $form->field($model, 'url') ?>
    <?php endif ?>

    <?php if ($model->name == "auth_keys"): ?>

        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
    <?php endif ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- update -->
