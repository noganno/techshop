<?php

use johnitvn\ajaxcrud\CrudAsset;

/* @var $this soft\web\SView */
/* @var $searchModel backend\models\search\WarrantySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Manufacturers');
$this->params['breadcrumbs'][] = $this->title;
CrudAsset::register($this);
$this->renderCrudModal();

?>
<div id="ajaxCrudDatatable">
    <?= \soft\grid\SKGridView::widget([
        'id' => 'crud-datatable',
        'panel' => [
            'heading' => $this->title,
            'after' => false,
        ],
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'pjax' => true,
        'cols' => [
            'name',
            'image:littleImage',
            'url:url',
            'show_in_index_page:bool',
            'actionColumn',
        ]
    ]) ?>
</div>
