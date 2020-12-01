<div class="row">
    <div class="col-md-4">
        <?php echo \yii\widgets\DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                [
                    'label' => t('Stock Status'),
                    'attribute' => 'stockStatus.name'
                ],
                'quantity',
                [
                    'label' => t('Manufacturer ID'),
                    'attribute' => 'manufacturer.name'
                ],

                'model',
                'price',
                'sale_price',
                'loan_price',
            ],
        ]); ?>

    </div>
    <div class="col-md-4">
        <img class="img img-responsive" src="<?=$model->image?>" alt="">
    </div>
    <div class="col-md-4">

    </div>
</div>