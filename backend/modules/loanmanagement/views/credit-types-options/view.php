<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CreditTypesOptions */
?>
<div class="credit-types-options-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'credit_type_id',
            'month',
            'deposit',
            'foiz',
        ],
    ]) ?>

</div>
