<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use soft\grid\SKGridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this soft\web\SView */
/* @var $searchModel common\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCrudAsset();
$this->renderCrudModal();

?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Page'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <? echo SKGridView::widget([
        'id' => 'crud-datatable',
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'panel' => [
            'after' => false,
        ],
        'cols' => [
//            'checkboxColumn',
            'title',
//            [
//                'attribute' => 'category_id',
//                'value' => function ($model) {
//                    return $model->category->title;
//                },
////                'filter' => $categoriesFilter,
//            ],
          /*  'updated_at',
            'created_at',*/
            [
                    'attribute' => 'pageIconGrid',
                'format' => 'raw',
            ],
            [
                'attribute' => 'url',
                'format' => ['url', ['target' => '_blank', 'data-pjax' => 0]],
            ],
            'middle:bool',

            [
                'attribute' => 'status',
                'format' => 'status',
                'filter' => [
                    '1' => t('Active'),
                    '0' => t('Inactive'),
                ]
            ],
            'actionColumn',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
