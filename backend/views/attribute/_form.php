<?php

use common\models\AttributeGroup;
use kartik\select2\Select2;
use kartik\widgets\SwitchInput;
use yeesoft\multilingual\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Attribute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attribute-form">

    <?php if (Yii::$app->session->hasFlash('message')) : ?>
        <div class="alert alert-info" role="alert">
            <?= Yii::$app->session->getFlash('message') ?>
        </div>
    <?php endif; ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?//= $form->languageSwitcher($model); ?>

    <?= $form->field($model, 'categoryIds')->widget(\kartik\tree\TreeViewInput::class, [
        'query' => \common\models\Category::find()->addOrderBy('root, lft'),
        'autoCloseOnSelect' => false,
        'value' => true,
        'headingOptions' => ['label' => Yii::t('app', 'Category')],
        'rootOptions' => ['label' => '<i class="fas fa-tree text-success"></i>'],
        'fontAwesome' => true,
        'asDropdown' => true,
        'multiple' => true,
        'options' => ['disabled' => false]
    ]); ?>

    <br>

    <?= $form->field($model, 'attribute_group_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(AttributeGroup::find()->all(), 'id', 'title'),
        'language' => 'uz',
        'options' => [
            'placeholder' => Yii::t('app', "Select Attribute Group"),
            'multiple' => false,
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'filter')->widget(SwitchInput::classname(), []); ?>
    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), []); ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>