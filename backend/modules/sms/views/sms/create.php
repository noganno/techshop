<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sms\models\Sms */

$this->title = Yii::t('app', 'Create Sms');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
