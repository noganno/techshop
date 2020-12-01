<?php

use soft\helpers\SHtml;
use soft\helpers\SUrl;
use soft\kartik\SDetailView;

/* @var $this soft\web\SView */
/* @var $model backend\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= SHtml::encode($this->title) ?></h1>

    <p>
        <?= SHtml::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= SHtml::a(Yii::t('app', 'Delete'), ['/general/delete-model', 'modelClass' => $model->className(), 'id' => $model->id, 'returnUrl' => SUrl::to(['index']) ], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= SDetailView::widget([
        'model' => $model,
        'panel' => [
            'heading' => "Details",
        ],
        'buttons1' => false,
        'attributes' => [
            'id',
            'user_id',
            'created_at',
            'updated_at',
            'status',
            'region_id',
            'statusLabel',
        ],
    ]) ?>

</div>
