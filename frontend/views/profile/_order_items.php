<?php

//dump($model);

?>

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h5><?= t('Payments') ?></h5>
            <ul class="list-group">
                <?php foreach ($model['PaymentsList'] as $payment): ?>
                    <li class="list-group-item">Квитанция: <?= $payment['Number'] ?>
                        от <?= Yii::$app->formatter->asDatetime($payment['Date']) ?>
                        <span
                                style="float: right"><?= Yii::$app->formatter->asSum($payment['Sum']) ?></span></li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>

</div>