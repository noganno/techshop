<?php

use zxbodya\yii2\galleryManager\GalleryManager;


?>

<div class="col-md-9">


    <?php
    if ($model->isNewRecord) {
        echo t('Can not upload images for new record');
    } else {
        echo GalleryManager::widget(
            [
                'model' => $model,
                'behaviorName' => 'galleryBehavior',
                'apiRoute' => 'product/galleryApi'
            ]
        );
    }
    ?>
</div>
