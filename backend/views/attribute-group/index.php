<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this soft\web\SView */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Attribute Group');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCrudAsset();
$this->renderCrudModal();

?>

<h1><?= Html::encode($this->title) ?></h1>
<p>
    <?= \soft\helpers\SHtml::createButton() ?>
</p>

<?php
$columns = [
    [
        'attribute' => 'title',
        'vAlign' => 'middle',
    ],
    'actionColumn' => [
        'template' => '{update} {delete}',
    ],

];

?>
<? echo \soft\grid\SKGridView::widget([
    'id' => 'crud-datable',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'cols' => $columns,
]); ?>
