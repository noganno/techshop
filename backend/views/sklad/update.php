<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sklad */

$this->title = Yii::t('app', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sklads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sklad-update">

    <h1><?= Html::encode($model->description) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
