<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this soft\web\SView */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
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
    [
        'class' => '\kartik\grid\ExpandRowColumn',
        'expandIcon' => "<i class='fa fa-plus-square-o'></i>",
        'collapseIcon' => "<i class='fa fa-minus-square-o'></i>",
        'format' => 'raw',
        'value' => function () {
            return GridView::ROW_COLLAPSED;
        },
        'expandOneOnly' => true,
        'detail' => function ($model) {

            return  tag('h4', $model->name ." - По складам") . $model->skladList;

        }
    ],
    [
        'attribute' => 'name',
        'vAlign' => 'middle',
    ],
    [
        'label' => t('Image'),
        'value' => function ($m) {
            return $m->getImage('cart');
        },
        'vAlign' => 'middle',
        'format' => ['image', ['style' => 'max-height:75px;max-width:75px;display: block;margin-left: auto;margin-right: auto;']],
    ],
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
    'unique_id' => [
        'width' => '20px',
        'contentOptions' => [
            'style' => 'word-wrap:anywhere',
        ]
    ],
    [
        'attribute' => 'categoryIds',
        'value' => function ($model) {
            return $model->categoryList;
        },
        'width' => '200px',

        'format' => 'raw',
        'filterType' => '\kartik\tree\TreeViewInput',
        'filterWidgetOptions' => [
            'query' => \backend\models\CategoryWithoutTranslations::find()->addOrderBy('root, lft')->andWhere(['!=', 'lvl', 0]),
            'autoCloseOnSelect' => false,
            'value' => true,
            'headingOptions' => ['label' => Yii::t('app', 'Category')],
            'rootOptions' => ['label' => '<i class="fas fa-tree text-success"></i>'],
            'fontAwesome' => true,
            'asDropdown' => true,
            'multiple' => true,
            'options' => ['disabled' => false],
            'cascadeSelectChildren' => true,

        ]

    ],

    [
        'attribute' => 'skladId',
        'hAlign' => 'center',
        'label' => t('Quantity'),
        'width' => '200px',
        'value' => function ($m) {

            if (isset($_GET['ProductSearch']['skladId'] )){

                $skladId = $_GET['ProductSearch']['skladId'];
                
                $ps = \common\models\ProductToSklad::findOne(['sklad_id' => $skladId, 'product_id' => $m->id]);
                if ($ps != null){
                    return $ps->quantity;
                }
            }

            return $m->totalQuantity;
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
    [
        'attribute' => 'status',
        'vAlign' => 'middle',
        'filter' => [
            '1' => Yii::t('app', 'Active'),
            '0' => Yii::t('app', 'Inactive'),
        ],
        'format' => 'status',
    ],
    [
        'attribute' => 'labelSort',
        'vAlign' => 'middle',
        'filter' => [
            'recommend' => Yii::t('app', 'Recommend'),
            'xit' => Yii::t('app', 'Xit'),
            'yellow_friday' => Yii::t('app', 'Yellow Friday'),
            'new' => Yii::t('app', 'New'),
        ],
    ],
    'actionColumn',

];

?>

    <? echo \soft\grid\SKGridView::widget([
    'id' => 'crud-datatable',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'containerOptions' => [
        'style' => 'min-height:500px'
    ],

    'bulkButtonsTemplate' => "{category}",
    'bulkButtons' => [
        'category' => [
            'label' => t('Categories'),
            'icon' => 'list',
            'style' => 'btn-primary',
            'url' => url_to(['product/bulk-category']),

        ]
    ],
    'cols' => $columns,
]); ?>
