<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SpecialOffer */

$this->title = Yii::t('app', 'Create Special Offer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Special Offers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="special-offer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
