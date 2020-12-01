<?php

use kartik\widgets\ActiveForm;
/* @var $model \common\models\Product */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

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

    <input type="hidden" name="pks" value="<?= $pks ?>">

    <?php ActiveForm::end(); ?>
</div>