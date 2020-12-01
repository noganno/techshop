<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\ipakyuli\models\IpakyuliTransactions */

$this->title = Yii::t('app', 'Update Ipakyuli Transactions: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ipakyuli Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ipakyuli-transactions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
