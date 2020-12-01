<?phpuse yii\helpers\Html;use yii\widgets\DetailView;/* @var $this yii\web\View *//* @var $model common\models\Post */$this->title = substr($model->title, 0, 80);$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reviews'), 'url' => ['index']];$this->params['breadcrumbs'][] = $this->title;?><div class="post-view">    <h3><?= Html::encode($model->title) ?></h3>    <p>        <?= \soft\helpers\SHtml::updateButton($model->id) ?>        <?= a(Yii::t('app', 'Update images'), ['update-images', 'id' => $model->id],  ['class' => 'btn btn-success'], 'image' ) ?>    </p>    <?= \soft\kartik\SDetailView::widget([        'model' => $model,        'panel' => [            'heading' => $model->title,        ],        'attributes' => [//            'id',            ['group' => true, 'label' => Yii::t('app', 'Title') ],            'title',            'slug',            ['group' => true, 'label' => Yii::t('app', 'Details') ],            [                    'attribute' => 'productName',            ],            'published_at' => [                'format' => 'dateTimeUz',            ],            'status',            'created_at',            'updated_at',          /*  ['group' => true, 'label' => Yii::t('app', 'Tags') ],            'tags',*/            ['group' => true, 'label' => Yii::t('app', 'Meta') ],            'meta_title',            'meta_description',            'meta_keywords',//            ['group' => true, 'label' => Yii::t('app', 'Images') ],            'image_index' => [                'format' => 'littleImage',            ],            'image_grid' => [                'format' => 'littleImage',            ],            'image_detail' => [                'format' => ['littleImage', '300px'],            ],            ['group' => true, 'label' => Yii::t('app', 'Content') ],            'content' => [                'format' => 'raw',            ],        ],    ]) ?></div>