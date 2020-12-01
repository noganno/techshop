<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Warranty */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => t('Manufacturers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <?= \soft\helpers\SHtml::updateButton($model->id) ?>
</p>
<?= \soft\kartik\SDetailView::widget([
    'model' => $model,
    'panel' => [
        'heading' => $this->title,
    ],
    'attributes' => [
        'id',
        'name',
        'url' => [
            'format' => 'url',
        ],
        'show_in_index_page' => [
            'format' => 'bool',
        ],
        'image',

    ],
]) ?>
