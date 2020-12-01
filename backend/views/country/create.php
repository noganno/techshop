<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Country */
$this->title = t('Create new');
$this->params['breadcrumbs'][] = ['label' => t('Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Country-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
