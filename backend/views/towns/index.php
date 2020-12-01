<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this soft\web\SView */
/* @var $searchModel common\models\TownsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Towns');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="towns-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= \soft\helpers\SHtml::createButton() ?>
    </p>

    <?= \soft\grid\SKGridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'panel' => [
            'after' => false,
            'footer' => false,
        ],
        'cols' => [
            'name',
            'created_at',
            'status:status',
//            'updated_at',
            'actionColumn',

        ],
    ]); ?>
</div>
