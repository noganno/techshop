<?php

use soft\helpers\SHtml;
use soft\kartik\SDetailView;

/* @var $this backend\components\BackendView */
/* @var $model backend\modules\usermanager\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= SHtml::encode($this->title) ?></h1>

    <p>
        <?= SHtml::updateButton($model->id) ?>
    </p>

    <?= SDetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'name',
            'surname',
            'father_name',
            [
                'attribute' => 'email',
                'format' => 'email',
            ],
            [
                'attribute' => 'town_id',
                'value' => $model->town->name ?? '',
            ],
            [
                'attribute' => 'status',
                'value' => $model->getStatusLabel(),
                'format' => 'raw',
            ],
            'created_at',
            'updated_at',
            'phone',
            'address',
            'image' => [
                'format' => 'littleImage',
            ],
            'guid',
        ],
    ]) ?>

</div>
