<?php

    use yii\helpers\Html;

    $this->title = Yii::t('app', 'Sms settings');
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sms manager'), 'url' => ['/smsmanager']];
    $this->params['breadcrumbs'][] = $this->title;

?>

<div class="availability-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'name',
            [
                'attribute' => 'value',
                'format' => 'raw',
                'contentOptions' => [
                    'style' => 'word-wrap:anywhere',
                ],
            ],
            'updated_at:datetime',
            [
                 'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                        'update' => function($url, $model, $key){

                            if ($model->idn == 'token'){

                                return Html::a('<span class="glyphicon glyphicon-refresh">',
                                    ['update-token'],
                                    [
                                            'class' => 'btn btn-sm btn-info',
                                            'title' => Yii::t('app', 'Update token'),

                                    ]);

                            }

                            return Html::a('<span class="glyphicon glyphicon-pencil">',
                                    ['update-settings', 'id' => $key],
                                    ['class' => 'btn btn-sm btn-success']);

                        }
                ]
            ],
        ],
    ]); ?>
</div>

