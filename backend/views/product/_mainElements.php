<?php


?>

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
<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


<?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'meta_keyword')->textInput(['maxlength' => true]) ?>

