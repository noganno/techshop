<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Length */

$this->title = Yii::t('app', 'Create Length');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lengths'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="length-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
