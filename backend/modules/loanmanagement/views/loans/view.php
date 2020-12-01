<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Loans */
?>
<div class="loans-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'fio',
            'birth_date',
            'address',
            'passport_number',
            'passport_give_date',
            'passport_expiry',
            'paasport_authority',
            'passport_propiska',
            'inn',
            'annual_income',
            'mobile_phone',
            'home_phone',
            'work_phone',
            'total_amount',
        ],
    ]) ?>

</div>
