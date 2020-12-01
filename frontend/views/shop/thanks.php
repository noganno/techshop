<?php

$this->title = t('Thanks');
$this->params['breadcrumbs'][] = $this->title;

?>


    <!-- Start of .main-block -->
    <div class="main-block thanks-page">

        <div class="auto-container thanks-page__block p-4 p-md-5">
            <div class="thanks-page__block-inner">
                <div class="icon">
                    <?= \yii\helpers\Html::img('/images/png/success.png') ?>
                </div>
                <h1 class="title"><?= Yii::t('app', 'Thanks {id} {datetime} created', [
                        'datetime' => Yii::$app->formatter->asDatetime($datetime),
                        'id' => $id
                    ]) ?></h1>
                <p class="description">
                    <?= t('near Contacts') ?>
                </p>
                <a href="<?= \yii\helpers\Url::home() ?>" class="link-blue"><?= t('Home') ?></a>
            </div>
        </div>
    </div>
    <!-- End of .main-block -->
<?php

//echo $paymentForm;

?>