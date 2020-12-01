<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this soft\web\SView */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Attributes');
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
        'attribute' => 'title',
        'vAlign' => 'middle',
    ],
    [
            'attribute' => 'filter',
        'format' => 'bool',
        'filter' => [
                0 => t('No', 'yii'),
                1 => t('Yes', 'yii'),
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
   // 'status',
    [
        'attribute' => 'attribute_group_id',
        'value' => function ($m) {
            return $m->attributeGroup->title;
        },
        'filter' => \yii\helpers\ArrayHelper::map(\common\models\AttributeGroup::find()->all(), 'id', 'title'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => Yii::t('app', 'Select Attrigube Group..')],
            'pluginOptions' => [
                    'allowClear' => true,
            ]

        ]
    ],
    'actionColumn' => [
            'template' => '{update} {delete}',
    ],

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
            'url' => url_to(['attribute/set-category']),

        ]
    ],
    'cols' => $columns,
]); ?>
