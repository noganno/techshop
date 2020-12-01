<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Warranty */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => t('Payment Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \soft\kartik\SDetailView::widget([
    'model' => $model,
    'panel' => [
        'heading' => $this->title,
    ],
    'attributes' => [
        'id',
        'name',
        'created_at',
        'updated_at',
    ],
]) ?>
