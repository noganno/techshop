<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Country */
$this->title = t('Update');
$this->params['breadcrumbs'][] = ['label' => t('Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Country-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
