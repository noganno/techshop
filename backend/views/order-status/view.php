<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OrderStatus */
?>
<div class="order-status-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'slug',
            'status',
            'type',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
