<?php
use yii\helpers\Html;
use soft\widgets\SActiveForm;
use soft\form\SForm;

?>

<div class="credit-types-options-form">

    <?php $form = SActiveForm::begin(); ?>

    <?= $form->field($model, 'credit_type_id')->widget(\kartik\select2\Select2::class,[
            'data'=>\yii\helpers\ArrayHelper::map(\common\models\CreditTypes::find()->all(),'id','name')
    ]) ?>

    <?= $form->field($model, 'month')->textInput() ?>

    <?= $form->field($model, 'deposit')->textInput() ?>

    <?= $form->field($model, 'foiz')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
