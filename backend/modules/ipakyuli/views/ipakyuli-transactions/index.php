<?php

use soft\grid\SKGridView;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\ipakyuli\models\IpakyuliTransactionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ipakyuli Transactions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ipakyuli-transactions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ipakyuli Transactions'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= SKGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'cols' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => t('Transaction ID'),
                'attribute' => 'id',
            ],
//            'global_id',
            [
                'label' => t('Order'),
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a(Html::encode(t('View')), ['/order', 'id' => $data->order_id]);
                },
            ],
            'amount:sum',
//            'terminal_num',

            [
                'attribute' => "room",
                'label'=>"Enter to cabinet",
                'value' => function ($data) {
                    return $data->room?t('Enter'):"";
                }
            ],
            [
                'label' => t('User'),
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a(Html::encode(t('View')), ['/usermanager/default/view', 'id' => $data->user_id]);
                },
            ],
            'success_date:datetime',
            'error_date:datetime',
//            'error_code',
            'status:text',
//            'return_html:ntext',
//            'return_success_json:ntext',
//            'return_error_json:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{view}"
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
