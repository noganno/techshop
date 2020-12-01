<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\ipakyuli\models\IpakyuliSettings */

$this->title = Yii::t('app', 'Create Ipakyuli Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ipakyuli Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ipakyuli-settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
