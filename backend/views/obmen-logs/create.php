<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ObmenLogs */

$this->title = Yii::t('app', 'Create Obmen Logs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Obmen Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obmen-logs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
