<?php

use soft\kartik\SActiveForm;
use soft\service\InputType;
use yii\web\JsExpression;


$this->title = $model->name;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'New products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Merge');

?>

<div class="post-form">

    <h1><?= $this->title ?></h1>

    <?php $form = SActiveForm::begin(); ?>

    <?= \soft\form\SFormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => false,
        'rows' => [
            [
                'columns' => 1,
                'compactGrid' => true,
                'attributes' => [
                    'selectedProductId' => [
                        'type' => InputType::SELECT2,
                        'label' => t('Select a product'),
                        'options' => [
                            'options' => [
                                'multiple'=>false,
                                'placeholder' =>  Yii::t('app', 'Select a product ...'),
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 3,
                                'language' => [
                                    'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                ],
                                'ajax' => [
                                    'url' => url_to(['product-list']),
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(params) { console.log(params);  return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup }'),
                                'templateResult' => new JsExpression('function(city) { return city.name }'),
                                'templateSelection' => new JsExpression('function (city) {   return city.name }'),
                            ],
                        ],

                    ],

                ]
            ],


        ]

    ]);

    ?>
    <?= \soft\helpers\SHtml::submitButton() ?>
    <?php SActiveForm::end(); ?>
</div>

