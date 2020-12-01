<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LegalOrders */
?>
<div class="legal-orders-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fio',
            'phone',
            'email:email',
            'company_name',
            'product_info',
        ],
    ]) ?>

</div>
