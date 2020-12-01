<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\QuickOrders */
?>
<div class="quick-orders-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product_id',
            'total_amount',
            'name',
            'phone',
            'status',
        ],
    ]) ?>

</div>
