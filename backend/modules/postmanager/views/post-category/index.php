<?phpuse yii\helpers\Html;use soft\grid\SKGridView;    $this->title = Yii::t('app', 'Post Categories');    $this->params['breadcrumbs'][] = $this->title;    $this->registerCrudAsset();    $this->renderCrudModal();?><div class="post-category-index">    <h1><?= Html::encode($this->title) ?></h1>    <p>       <?= \soft\helpers\SHtml::createButton() ?>    </p>    <?= SKGridView::widget([        'id' => 'crud-datatable',        'dataProvider' => $dataProvider,        'filterModel' => $searchModel,        'cols' => [            'checkboxColumn',            'title_uz',            'title_kr',            'title_ru',            'status',            'slug',//            [//                'label' => Yii::t('app', 'Post count'),//                'value' => function ($m) {//                    return count($m->posts);//                }//            ],            'actionColumn',        ],    ]); ?></div>