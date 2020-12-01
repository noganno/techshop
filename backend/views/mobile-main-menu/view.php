<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MobileMainMenu */
?>
<div class="mobile-main-menu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'image',
            'order',
        ],
    ]) ?>

</div>
