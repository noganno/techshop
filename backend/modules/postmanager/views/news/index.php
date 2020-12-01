<?phpuse yii\helpers\Html;use soft\grid\SKGridView;/* @var $this soft\web\SView *//* @var $searchModel common\models\search\PostSearch *//* @var $dataProvider yii\data\ActiveDataProvider */$this->title = Yii::t('app', 'News');$this->params['breadcrumbs'][] = $this->title;$this->renderCrudModal();$this->registerCrudAsset();?><div class="post-index">    <h1><?= Html::encode($this->title) ?></h1>    <p>        <?= \soft\helpers\SHtml::createButton() ?>    </p>    <?= SKGridView::widget([        'id' => 'crud-datatable',        'dataProvider' => $dataProvider,        'filterModel' => $searchModel,        'cols' => [            'checkboxColumn',            'title',            'status',            'image_index:littleImage',            'published_at:dateTimeUz',            'actionColumn' => [                'width' => '150px',                'template' => "{view} {update} {delete} {image}",                'buttons' => [                    'image' => function ($url, $model, $key) {                        return a(fa('image'), ['update-images', 'id' => $key], [                            'title' => t('Upadte images'),                            'data' => [                                'toggle' => 'tooltip',                                'pjax' => 0,                            ],                            'class' => 'btn btn-success btn-xs',                        ]);                    }                ]            ],        ],    ]); ?></div>