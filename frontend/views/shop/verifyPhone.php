<?php


use yii\bootstrap4\ActiveForm;


$sum = 0;
$total = 0;
$this->title = t("Verify Number");
$this->params['breadcrumbs'][] = $this->title;


?>
    <!-- Start of .main-block -->
    <div class="main-block ordering">

<?php $form = ActiveForm::begin(['options' => ['class' => 'auto-container']]); ?>
<?php $form->errorSummary($model); ?>
    <div class="container">
        <h1 class="title"><?= $this->title ?></h1>
        <p class="text"><?= t('You need verify your phone with verification phone') ?></p>

        <div class="form-row mt-4">
            <?= $form->field($model, 'code', ['options' => ['class' => 'form-group col-md-6 col-12 col-xl-4']])->textInput([
                'class' => 'form-control',
                'placeholder' => t('Code'),
            ])->label(false) ?>

        </div>
        <div class="form-row mt-4">
            <button class="btn btn-yellow-3">Оформить заказ</button>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- End of .main-block -->
<?php
