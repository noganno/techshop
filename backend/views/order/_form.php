<?php

use soft\helpers\SHtml;
use soft\kartik\SActiveForm;
use soft\form\SForm;

/* @var $this soft\web\SView */
/* @var $model backend\models\Order */
/* @var $form SActiveForm */
?>

<div class="row">
    <div class="col-md-6">
        <?php $form = SActiveForm::begin(); ?>
        <?= SForm::widget([
            'model' => $model,
            'form' => $form,
            'attributes' => [
                'status',
                'region_id',
            ],
        ]);
        ?>
        <div class="form-group">
            <?= SHtml::submitButton() ?>
        </div>
        <?php SActiveForm::end(); ?>
    </div>
</div>
