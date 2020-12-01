<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Warranty */
$this->title = t('Update');
$this->params['breadcrumbs'][] = ['label' => t('Warranties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warranty-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
