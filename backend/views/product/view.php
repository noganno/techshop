<?php

use yii\helpers\Html;
use soft\kartik\SDetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view product_card">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= SDetailView::widget([
        'model' => $model,
        'attributes' => [
            ['group' => true, 'label' => t("Name")],
            'name',
            ['group' => true, 'label' => t("Cost")],
            'price' => [
                'format' => 'sum',
            ],
            'sale_price' => [
                'format' => 'sum',
            ],
            'loan_price' => [
                'format' => 'sum',
            ],
            'deposit',
            ['group' => true, 'label' => t("Details")],
            'id',
            'slug',
            'model',
//            'quantity',
            'quantity',
//            'stock_status_id',
            'xit' => [
                'format' => 'bool'
            ],

            'recommend' => [
                'format' => 'bool'
            ],
            'yellow_friday' => [
                'format' => 'bool'
            ],

            'timeAddedMain' => [
                'format' => 'fullDateUz',
            ],
            'isNew' => [
                'format' => 'bool',

            ],
//            'country_id' => [
//                    'value' => $model->country->name ?? '',
//            ],
//            'manufacturer_id' => [
//                    'value' => $model->manufacturer->name ?? '',
//            ],
//            'warranty_id' => [
//                    'value' => $model->warranty->name ?? '',
//            ],

//            'weight',
//            'weight_class_id',
//            'length',
//            'length_class_id',
//            'sort_order',
            'status',
            'viewed',
            'created_at',
            'updated_at',
            ['group' => true, 'label' => t("Images")],
            'imagesField' => [
                'label' => t('Images'),
                'value' => $model->getImagesField(),
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div>
