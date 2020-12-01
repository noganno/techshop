<?php

use soft\kartik\SActiveForm;
?>

<div class="post-form">
    <?php $form = SActiveForm::begin(); ?>
    <?= \soft\form\SForm::widget([
        'model' => $model,
        'form' => $form,
        'attributes' => [
            'name',
        ]
    ]);
    ?>
    <?php  if(!Yii::$app->request->isAjax): ?>
    <?= \soft\helpers\SHtml::submitButton() ?>
    <?php endif    ?>
    <?php SActiveForm::end(); ?>
</div>

