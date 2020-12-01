<?php

    use kartik\widgets\ActiveForm;
    use yii\helpers\Url;
    use odilov\cropper\Cropper;

$this->title = Yii::t('app', 'Update images');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Promotions and discounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
    <div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <div class="box-body">

<?php $form = ActiveForm::begin(['id' => 'form-profile']); ?>
    <?php echo $form->field($model, 'image_index')->widget(Cropper::className(), [
        'uploadUrl' => Url::toRoute('uploadimage'),
        'width' => 260,
        'height' => 150,
    ]) ?>

    <?php echo $form->field($model, 'image_grid')->widget(Cropper::className(), [
        'uploadUrl' => Url::toRoute('uploadimage'),
        'width' => 300,
        'height' => 300,

    ]) ?>

    <?php echo $form->field($model, 'image_detail')->widget(Cropper::className(), [
        'uploadUrl' => Url::toRoute('uploadimage'),
        'width' => 1200,
        'height' => 300,
    ]) ?>
    <div class="form-group">
        <?php echo \soft\helpers\SHtml::submitButton() ?>
    </div>
<?php ActiveForm::end(); ?>
    </div>
    </div>
