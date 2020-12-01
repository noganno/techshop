<?php

use common\models\CreditTypes;
use yii\helpers\Html;
use soft\kartik\SActiveForm;
use soft\form\SForm;
?>
<div class="credit-types-options-form">
    <?php $form = SActiveForm::begin(); ?>
    <?= SForm::widget([
               'model' => $model,
                'form' => $form,
                'attributes' => [
                    'credit_type_id' => [
                        'map' => [
                            'array' => CreditTypes::find()->all(),
                        ]
                    ],
                    'month',
                    'deposit',
                    'foiz',
                ]
            ]);
    ?>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>
    <?php SActiveForm::end(); ?>
</div>
