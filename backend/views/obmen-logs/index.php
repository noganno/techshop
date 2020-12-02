<?php

use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ObmenLogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Obmen Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obmen-logs-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    $columns = [
        'checkboxColumn',
        'name',
        [
            'attribute' => 'action',
            'hAlign' => 'center',
            'label' => t('Action'),
            'width' => '200px',
            'value' => function ($model) {
                return t($model->action);
            },

            'filter' => [
                'action_count_change' => t('action_count_change'),
                'action_price_change' => t('action_price_change'),
                'action_name_change' => t('action_name_change'),
            ],
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'options' => ['prompt' => Yii::t('app', 'Action')],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]

        ],
        'is_from_1c:boolean',
        'wrote_to_site:boolean',
        [
            'attribute' => 'datetime', //value does not need to format time if the timestamp type is datetime
            'label' => Yii::t('app', 'DateTime'),
            'filterType' => GridView::FILTER_DATE_RANGE,
            'value' => function ($model) {
                if ($model->datetime) {
                    return date('Y-m-d H:i:s', $model->datetime);
                }
                return null;
            },
            'filterWidgetOptions' => [
                'startAttribute' => 'created_at_c', //Attribute of start time
                'endAttribute' => 'created_at_e',   //The attributes of the end time
                'convertFormat' => true, // Importantly, true uses the local - > format time format to convert PHP time format to js time format.
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd hh:ii:ss',//Date format
                    'timePicker' => true, //Display time
//                        'Time Picker Increment'=>5, //min interval
                    'timePicker24Hour' => true, //24 hour system
                    'locale' => ['format' => 'Y-m-d H:i:s'], //php formatting time
                ]
            ],
        ],
        'sale_price',
        'loan_price',
        'guid',
        [
            'attribute' => 'sklad_id',
            'hAlign' => 'center',
            'label' => t('SKladID'),
            'width' => '200px',
            'value' => function ($model) {
                return $model->sklad->description;
            },

            'filter' => \yii\helpers\ArrayHelper::map(\common\models\Sklad::find()->all(), 'id', 'description'),
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'options' => ['prompt' => Yii::t('app', 'Sklads')],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]

        ],
        'count',

//        'actionColumn' => [
//            'width' => '150px',
//            'template' => "{view} {update} {select} {add-to-main} {delete}",
//            'buttons' => [
//                'select' => function ($url) {
//
//                    return a('', $url, ['class' => 'btn btn-xs btn-warning', 'data-pjax' => 0, 'title' => t('Merge')], 'link');
//                },
//
//                'add-to-main' => function ($url) {
//                    return a('', $url, [
//
//                        'class' => 'btn btn-xs btn-success',
//                        'data' => [
//                            'pjax' => 0,
//                            'method' => 'post',
//                            'confirm-title' => t('Are you sure'),
//                            'confirm' => t('Do you want to add this product to main products?'),
//                        ],
//                        'title' => t('Add this product to main products'),
//
//
//                    ], 'plus');
//                }
//
//            ]
//
//        ],

    ];

    ?>
    <? echo \soft\grid\SKGridView::widget([
        'id' => 'crud-datable',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'bulkButtons' => false,
        'toolbarTemplate' => '{refresh}',
        'cols' => $columns,
    ]); ?>

    <?php Pjax::end(); ?>

</div>
