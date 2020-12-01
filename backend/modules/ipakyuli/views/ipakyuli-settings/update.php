<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\ipakyuli\models\IpakyuliSettings */

$this->title = Yii::t('app', 'Update');?>
<div class="ipakyuli-settings-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
