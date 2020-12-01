<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CreditTypes */
?>
<div class="credit-types-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'status',
            'bank',
        ],
    ]) ?>

</div>
