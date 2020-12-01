<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Warranty */
$this->title = t('Create new');
$this->params['breadcrumbs'][] = ['label' => t('Warranties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warranty-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
