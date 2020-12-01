<?php

use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this soft\web\SView */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sklads');
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
    'checkboxColumn',
    'name',
    [
        'attribute' => 'description',
        'vAlign' => 'middle',
    ],

    [
        'attribute' => 'region_id',
        'value' => function ($m) {
            return $m->region['name'];
        },
//        'hAlign' => 'center',
//        'width' => '200px',
        'filter' => \yii\helpers\ArrayHelper::map(\common\models\Towns::find()->all(), 'id', 'name'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => Yii::t('app', 'Select Region..')],
            'pluginOptions' => [
                    'allowClear' => true,
            ],
        ]
    ],


    'phone',
    [
        'attribute' => 'work_time',
        'vAlign' => 'middle',
    ],
    'in_map:boolean',
    'status',

    'actionColumn',

];

?>
<? echo \soft\grid\SKGridView::widget([
    'id' => 'crud-datable',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'cols' => $columns,
]); ?>
