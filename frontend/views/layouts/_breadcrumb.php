<?php

use yii\bootstrap4\Breadcrumbs;

$links = \soft\helpers\SArray::getValue($this->params, 'breadcrumbs', []);

?>

<div class="main-block">
    <!-- Start of .breadcrumb-outer -->
    <div class="breadcrumb-outer">
        <div class="auto-container">
            <?= Breadcrumbs::widget([
                'links' => $links,
            ]) ?>
        </div>
    </div>
    <!-- End of .breadcrumb-outer -->
</div>