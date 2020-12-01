<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Weight */

$this->title = Yii::t('app', 'Create Weight');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Weights'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weight-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
