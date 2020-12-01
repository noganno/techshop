<?php

use common\models\Category;
use kartik\tree\models\Tree;
use kartik\tree\models\TreeTrait;
use kartik\tree\Module;
use kartik\tree\TreeView;
use phpDocumentor\Reflection\Types\This;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss("
    
    .kv-tree li {
        line-height: normal;
        font-size: 14px;
    }

");

?>
<div class="category-index">



    <?= TreeView::widget([
        // single query fetch to render the tree
        // use the Product model you have in the previous step
        'query' => Category::find()->addOrderBy('root, lft'),
        'mainTemplate' => '
        <div class="row">
            <div class="col-sm-5">
                {wrapper}
            </div>
            <div class="col-sm-7">
                {detail}
            </div>
        </div>',
        'headingOptions' => ['label' => 'Categories'],
        'nodeView' => '@backend/views/category/_form2',
        'fontAwesome' => true,     // optional
        'isAdmin' => false,         // optional (toggle to enable admin mode)
        'displayValue' => 1,        // initial display value
        'softDelete' => true,       // defaults to true
        'cacheSettings' => [
            'enableCache' => true   // defaults to true
        ],
        'treeOptions' => [
                'class' => 'salom',
            'style' => 'height:1000px'
        ]
    ]); ?>

</div>