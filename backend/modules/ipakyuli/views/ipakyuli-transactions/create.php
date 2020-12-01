<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\ipakyuli\models\IpakyuliTransactions */

$this->title = Yii::t('app', 'Create Ipakyuli Transactions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ipakyuli Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ipakyuli-transactions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
