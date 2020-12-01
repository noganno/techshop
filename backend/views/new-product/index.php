<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this soft\web\SView */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'New products');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCrudAsset();
$this->renderCrudModal();

?>

<h1><?= Html::encode($this->title) ?></h1>

<?php
$columns = [
    'checkboxColumn',
    [
        'attribute' => 'name',
        'vAlign' => 'middle',
    ],
//    [
//            'label' => t('Image'),
//        'value' => function ($m) {
//            return $m->getImage('cart');
//        },
//        'format' => ['littleImage', '80px'],
//    ],

    'unique_id',
    'created_at',
    'updated_at',
    [
        'attribute' => 'sale_price',
        'format' => 'sum',
        'filter' => false,
    ],

    [
        'attribute' => 'loan_price',
        'format' => 'sum',
        'filter' => false,
    ],
    [
        'attribute' => 'totalQuantity',
        'hAlign' => 'center',
        'width' => '20px',
        'filter' => false,
    ],
    
   /* [
        'attribute' => 'status',
        'vAlign' => 'middle',
        'filter' => [
            '1' => Yii::t('app', 'Active'),
            '0' => Yii::t('app', 'Inactive'),
        ],
        'format' => 'status',
    ],*/
    'actionColumn' => [
        'width' => '150px',
        'template' => "{view} {update} {select} {add-to-main} {delete}",
        'buttons' => [
            'select' => function ($url) {

                return a('', $url, ['class' => 'btn btn-xs btn-warning', 'data-pjax' => 0, 'title' => t('Merge')], 'link');
            },

            'add-to-main' => function ($url) {
                return a('', $url, [

                    'class' => 'btn btn-xs btn-success',
                    'data' => [
                        'pjax' => 0,
                        'method' => 'post',
                        'confirm-title' => t('Are you sure'),
                        'confirm' => t('Do you want to add this product to main products?'),
                    ],
                    'title' => t('Add this product to main products'),


                ], 'plus');
            }

        ]

    ],

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
