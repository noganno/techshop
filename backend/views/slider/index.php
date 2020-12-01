<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sliders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php // Html::a(Yii::t('app', 'Create Slider'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <? echo \soft\grid\SKGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'cols' => [
            'checkboxColumn',
            'name',
//            [
//                'attribute' => 'category_id',
//                'value' => function ($model) {
//                    return $model->category->title;
//                },
////                'filter' => $categoriesFilter,
//            ],
//            'updated_at',
//            'created_at',
            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>"{update}"
            ],
        ],
    ]); ?>



</div>
